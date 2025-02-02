<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sell;
use App\Models\Customer;

use Illuminate\Http\Request;


class InvoiceController extends Controller
{
    public function viewInvoice($sellId)
    {
        $sell = Sell::with(['sellDetail'=>function($q){
            $q->with(['product']);
        }, 'customer'])->findOrFail($sellId);

        // If no customer exists, assign "General Customer"
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

    public function downloadInvoice($sellId)
    {
        $sell = Sell::with(['sellDetail'=>function($q){
            $q->with(['product']);
        }, 'customer'])->findOrFail($sellId);

        // Handle missing customer
        if (!$sell->customer) {
            $defaultCustomer = Customer::where('first_name', 'General')
                                        ->where('last_name', 'Customer')
                                        ->first();
            if ($defaultCustomer) {
                $sell->customer_id = $defaultCustomer->id;
                $sell->save();
            }
        }

        // Custom size for 58mm printer
        // $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
        //           ->setPaper([0, 0, 200, 500]); // Adjust height if needed


        $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
                  ->setPaper([0, 0, 160, 600]); // Adjust width (160pt = ~58mm)
        
        return $pdf->download('invoice_' . ($sell->invoice_no ?? 'N/A') . '.pdf');
    }



}
