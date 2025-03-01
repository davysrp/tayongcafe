<?php

namespace App\Http\Controllers;
use App\Models\Sell;
use App\Models\Customer;
use App\Models\SellDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{

    // public function viewInvoice($sellId,Request $request)
    // {
    //     $sell = Sell::with(['sellDetail'=>function($q){
    //         $q->with(['product']);
    //     }, 'customer'])->findOrFail($request->order_id);



    //     if (!$sell->customer) {
    //         $defaultCustomer = Customer::where('first_name', 'General')
    //                                     ->where('last_name', 'Customer')
    //                                     ->first();
    //         if ($defaultCustomer) {
    //             $sell->customer_id = $defaultCustomer->id;
    //             $sell->save();
    //         }
    //     }

    //     return view('backend.sells.invoice', compact('sell'));
    // }

    

    public function viewInvoice($sellId, Request $request)
    {
        // Retrieve the sell order with related details
        $sell = Sell::with(['sellDetail' => function($q) {
            $q->with(['product', 'productVariant']);
        }, 'customer', 'paymentMethod'])->findOrFail($request->order_id);
    
        // Format the invoice details into a message
        $invoiceDetails = "Date: " . ($sell->created_at ? $sell->created_at->format('d-m-Y h:i A') : 'N/A') . "\n\n";
        $invoiceDetails .= "Invoice №: " . ($sell->invoice_no ?? 'N/A') . "\n";
        $invoiceDetails .= "Customer: " . ($sell->customer ? $sell->customer->first_name . ' ' . $sell->customer->last_name : 'Guest') . "\n\n";
    
        $invoiceDetails .= "Item\tQty\tPrice\tTotal\n";
        $invoiceDetails .= "--------------------------------\n";
    
        foreach ($sell->sellDetail as $detail) {
            $itemName = $detail->product ? $detail->product->names : 'Unknown';
            if ($detail->productVariant) {
                $itemName .= ' ' . $detail->productVariant->variant_name;
            }
            $itemTotal = ($detail->qty ?? 1) * ($detail->price ?? 0);
            $invoiceDetails .= $itemName . "\t" . ($detail->qty ?? 1) . "\t$" . number_format($detail->price ?? 0, 2) . "\t$" . number_format($itemTotal, 2) . "\n";
        }
    
        $invoiceDetails .= "\nSubtotal: $" . number_format($sell->total ?? 0, 2) . "\n";
        $invoiceDetails .= "Discount: $" . number_format($sell->discount ?? 0, 2) . "\n";
        $invoiceDetails .= "Grand Total: $" . number_format($sell->grand_total ?? 0, 2) . "\n";
        $invoiceDetails .= "Paid by: " . ($sell->paymentMethod ? $sell->paymentMethod->names : 'N/A') . "\n";
    
        try {
            // Send the invoice details to Telegram
            $apiToken = env('TELEGRAM_BOT_TOKEN');
            $chatId = env('TELEGRAM_CHAT_CHANEL');
            $text = urlencode($invoiceDetails); // URL encode the message
    
            $response = \Http::get("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&text=$text");
    
            // Uncomment below if you want to return the Telegram API response
            // return $response->body();
        } catch (\Exception $exception) {
            return response()->json([
                'statusCode' => 200,
                'message' => 'Failed Notification',
                'success' => false,
                'data' => []
            ]);
        }
    
        // Return the view with the sell data
        return view('backend.sells.invoice', compact('sell'));
    }



    
    public function downloadInvoice($sellId, Request $request)
    {
        $sell = Sell::with(['sellDetail' => function ($q) {
            $q->with(['product']);
        }, 'customer'])->findOrFail($request->order_id);

        // Assign "General Customer" if no customer exists
        if (!$sell->customer) {
            $defaultCustomer = Customer::where('first_name', 'General')
                ->where('last_name', 'Customer')
                ->first();
            if ($defaultCustomer) {
                $sell->customer_id = $defaultCustomer->id;
                $sell->save();
            }
        }

        // Load view with data
        $pdf = PDF::loadView('backend.sells.invoice', compact('sell'))
            ->setPaper('A4', 'portrait') 
            ->setOption('dpi', 96) 
            ->setOption('defaultFont', 'KhmerOSBattambang')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true);

        return $pdf->download('invoice_' . $sell->id . '.pdf');
    }

}


