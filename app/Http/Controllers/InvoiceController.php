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
    public function viewInvoice($sellId,Request $request)
    {
        $sell = Sell::with(['sellDetail'=>function($q){
            $q->with(['product']);
        }, 'customer'])->findOrFail($request->order_id);



        if (!$sell->customer) {
            $defaultCustomer = Customer::where('first_name', 'General')
                                        ->where('last_name', 'Customer')
                                        ->first();
            if ($defaultCustomer) {
                $sell->customer_id = $defaultCustomer->id;
                $sell->save();
            }
        }

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


