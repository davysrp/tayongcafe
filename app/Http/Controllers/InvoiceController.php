<?php

namespace App\Http\Controllers;
use App\Models\Sell;
use App\Models\Customer;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function viewInvoice($sellId,Request $request)
    {
        $sell = Sell::with(['sellDetail'=>function($q){
            $q->with(['product']);
        }, 'customer'])->findOrFail($request->order_id);


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

<<<<<<< HEAD
        $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
                  ->setPaper([0, 0, 160, 600]);

=======
     /*   $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
            ->setOptions(['defaultFont' => 'NotoSansKhmer'])
                  ->setPaper([0, 0, 160, 600]); // Adjust width (160pt = ~58mm)
>>>>>>> 10562032fbec44a4c2deb69a46238faec7885a22

        return $pdf->download('invoice_' . ($sell->invoice_no ?? 'N/A') . '.pdf');*/

        $pdf = PDF::loadView('backend.sells.invoice', compact('sell'));

        $pdf->getMpdf()->SetPageSize([215.9, 279.4]);
        return $pdf->stream('invoice' . time() . '.pdf');


    }


    // public function generateInvoice($sellId)

    // {
    //     $sell = Sell::find($sellId);

    //     $pdf = Pdf::loadView('backend.sells.invoice', compact('sell'))
    //             ->setPaper([0, 0, 160, 600]) // 58mm width for receipt printing
    //             ->setOption('defaultFont', 'Battambang'); // Force Khmer font

    //     return $pdf->stream('invoice.pdf'); // Open in browser
    // }

    //

    // // Export report as PDF
    // public function exportPdf(Request $request)
    // {
    //     $startDate = $request->query('start_date', Carbon::now()->subDays(30)->toDateString());
    //     $endDate = $request->query('end_date', Carbon::now()->toDateString());

    //     $sales = Sell::whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
    //         ->select(DB::raw('DATE(created_at) as date, SUM(grand_total) as total_sales'))
    //         ->groupBy(DB::raw('DATE(created_at)'))
    //         ->orderBy('date', 'asc')
    //         ->get();

    //     $totalSales = $sales->sum('total_sales');

    //     // Load view into PDF
    //     $pdf = Pdf::loadView('backend.report.pdf', compact('sales', 'totalSales', 'startDate', 'endDate'));

    //     return $pdf->download('sales_report_' . $startDate . '_to_' . $endDate . '.pdf');
    // }

}


