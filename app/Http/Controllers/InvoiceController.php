<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sell;
use App\Models\Customer;

use Illuminate\Http\Request;


class InvoiceController extends Controller
{


    // public function viewInvoice($sellId)
    // {
    //     $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);
    //     return view('backend.sells.invoice', compact('sell'));
    // }

    // public function downloadInvoice($sellId)
    // {
    //     $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);

    //     $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
    //               ->setPaper('a4', 'portrait');

    //     return $pdf->download('invoice_' . $sell->invoice_no . '.pdf');
    // }


    // View Invoice
    // public function viewInvoice($sellId)
    // {
    //     $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);
    //     return view('backend.sells.invoice', compact('sell'));
    // }

    // // Download Invoice as PDF
    // public function downloadInvoice($sellId)
    // {
    //     $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);

    //     $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
    //               ->setPaper([0, 0, 220, 500]); // Custom receipt size

    //     return $pdf->download('invoice_' . $sell->invoice_no . '.pdf');
    // }


    // public function viewInvoice($sellId)
    // {
    //     $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);

    //     if (!$sell->customer) {
    //         return redirect()->back()->with('error', 'Customer not found for this order.');
    //     }

    //     return view('backend.sells.invoice', compact('sell'));
    // }
    // public function viewInvoice($sellId)
    // {
    //     $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);

    //     // If no customer exists, assign "General Customer"
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



    // public function downloadInvoice($sellId)
    // {
    //     $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);

    //     // If no customer exists, assign "General Customer"
    //     if (!$sell->customer) {
    //         $defaultCustomer = Customer::where('first_name', 'General')
    //                                     ->where('last_name', 'Customer')
    //                                     ->first();

    //         if ($defaultCustomer) {
    //             $sell->customer_id = $defaultCustomer->id;
    //             $sell->save();
    //         }
    //     }

    //     $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
    //               ->setPaper('a4', 'portrait');

    //     return $pdf->download('invoice_' . $sell->invoice_no . '.pdf');
    // }


    // public function downloadInvoice($sellId)
    // {
    //     $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);

    //     // If no customer exists, assign "General Customer"
    //     if (!$sell->customer) {
    //         $defaultCustomer = Customer::where('first_name', 'General')
    //                                     ->where('last_name', 'Customer')
    //                                     ->first();

    //         if ($defaultCustomer) {
    //             $sell->customer_id = $defaultCustomer->id;
    //             $sell->save();
    //         }
    //     }

    //     // Debug Filename Before Download
    //     $invoiceFileName = 'invoice_' . ($sell->invoice_no ?? 'N/A') . '.pdf';
    //     \Log::info('Invoice Filename: ' . $invoiceFileName);

    //     $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))

    //               //->setPaper('a4', 'portrait');
    //               ->setPaper([0, 0, 58, 220]); // Custom size (width x height in points)

    //     return $pdf->download($invoiceFileName);
    // }
    // public function downloadInvoice($sellId)
    // {
    //     $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);

    //     // If no customer exists, assign "General Customer"
    //     if (!$sell->customer) {
    //         $defaultCustomer = Customer::where('first_name', 'General')
    //                                     ->where('last_name', 'Customer')
    //                                     ->first();

    //         if ($defaultCustomer) {
    //             $sell->customer_id = $defaultCustomer->id;
    //             $sell->save();
    //         }
    //     }

    //     // Custom size for 58mm thermal printer
    //     $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
    //               ->setPaper([0, 0, 200, 500]); // Adjust height if needed

    //     return $pdf->download('invoice_' . ($sell->invoice_no ?? 'N/A') . '.pdf');
    // }



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
        $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
                  ->setPaper([0, 0, 200, 500]); // Adjust height if needed

        return $pdf->download('invoice_' . ($sell->invoice_no ?? 'N/A') . '.pdf');
    }



}
