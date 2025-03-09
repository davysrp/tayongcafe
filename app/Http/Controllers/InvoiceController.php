<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sell;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InvoiceController extends Controller
{
    // View Invoice
    public function viewInvoice($sellId, Request $request)
    {
        $sell = Sell::with(['sellDetail' => function ($q) {
            $q->with(['product', 'productVariant']);
        }, 'customer', 'paymentMethod'])->findOrFail($sellId);

        if (!$sell->invoice_no) {
            $sell->invoice_no = 'INV-' . str_pad($sell->id, 6, '0', STR_PAD_LEFT);
            $sell->save();
        }
        // Get all sales for the same date as this sale
        $salesForTheDay = Sell::whereDate('created_at', $sell->created_at->toDateString())
            ->orderBy('created_at', 'asc')
            ->get();

        // Assign queue numbers dynamically (start from 1)
        $queueNumber = 1;
        foreach ($salesForTheDay as $index => $sale) {
            if ($sale->id == $sell->id) {
                $queueNumber = $index + 1;
                break;
            }
        }
        // Format the invoice details into a message
        $invoiceDetails = "Date: " . ($sell->created_at ? $sell->created_at->format('d-m-Y h:i A') : 'N/A') . "\n";
        $invoiceDetails .= "Queue No:" . str_pad($queueNumber, 1, STR_PAD_LEFT) . "\n";

        $invoiceDetails .= "Invoice №: " . ($sell->invoice_no ?? 'Unknown') . "\n";
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
            $text = urlencode($invoiceDetails);

            Http::get("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&text=$text");
        } catch (\Exception $exception) {
            return response()->json([
                'statusCode' => 200,
                'message' => 'Failed Notification',
                'success' => false,
                'data' => []
            ]);
        }

        return view('backend.sells.invoice', compact('sell','queueNumber'));
    }

    // Download Invoice as PDF
    public function downloadInvoice($sellId)
    {
        $sell = Sell::with(['sellDetail' => function ($q) {
            $q->with(['product']);
        }, 'customer'])->findOrFail($sellId);

        if (!$sell->invoice_no) {
            $sell->invoice_no = 'INV-' . str_pad($sell->id, 6, '0', STR_PAD_LEFT);
            $sell->save();
        }

        $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('invoice_' . $sell->invoice_no . '.pdf'); // ✅ Always correct invoice number
    }
}
