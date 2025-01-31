<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sell;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    //  public function downloadInvoice($sellId)
    //  {
    //      $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);
 
    //      $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
    //                ->setPaper('a4', 'portrait');
 
    //      return $pdf->download('invoice_' . $sell->invoice_no . '.pdf');
    //  }
 
    //  public function viewInvoice($sellId)
    //  {
    //      $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);
    //      return view('backend.sells.invoice', compact('sell'));
    //  }     
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

    public function viewInvoice($sellId)
    {
        $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);
        return view('backend.sells.invoice', compact('sell'));
    }

    public function downloadInvoice($sellId)
    {
        $sell = Sell::with(['sellDetail.product', 'customer'])->findOrFail($sellId);

        $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('invoice_' . $sell->invoice_no . '.pdf');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
