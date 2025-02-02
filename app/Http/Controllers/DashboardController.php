<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\AccountRequest;
use App\Models\Sell;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        // Query for daily sells
        $dailySells = Sell::select(DB::raw('DATE(created_at) as date, SUM(grand_total) as total_sales'))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->get();
        $totalDailySales = $dailySells->sum('total_sales');
            
        // Query for weekly sells
        $weeklySells = Sell::select(DB::raw('WEEK(created_at) as week, YEAR(created_at) as year, SUM(grand_total) as total_sales'))
        ->groupBy(DB::raw('YEAR(created_at), WEEK(created_at)'))
        ->get();
        $totalWeeklySales = $weeklySells->sum('total_sales');
            
        // Query for monthly sells
        $monthlySells = Sell::select(DB::raw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(grand_total) as total_sales'))
        ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
        ->get();
        $totalMonthlySales = $monthlySells->sum('total_sales');
            
        // Query for yearly sells
        $yearlySells = Sell::select(DB::raw('YEAR(created_at) as year, SUM(grand_total) as total_sales'))
        ->groupBy(DB::raw('YEAR(created_at)'))
        ->get();
        $totalYearlySales = $yearlySells->sum('total_sales');
            
        // return view('backend.dashboard',compact('dailySells','weeklySells','monthlySells' ,'yearlySells'));
        return view('backend.dashboard', compact(
            'dailySells', 'weeklySells', 'monthlySells', 'yearlySells',
            'totalDailySales', 'totalWeeklySales', 'totalMonthlySales', 'totalYearlySales'
        ));
    }
    //Filter Reports 

    
    // public function report(Request $request)
    // {
    //     // Get date filter option from the request
    //     $filter = $request->input('filter');

    //     // Default: Current month sales
    //     $startDate = Carbon::now()->startOfMonth()->toDateString();
    //     $endDate = Carbon::now()->endOfMonth()->toDateString();

    //     // Handle predefined filters
    //     if ($filter == 'last_month') {
    //         $startDate = Carbon::now()->subMonth()->startOfMonth()->toDateString();
    //         $endDate = Carbon::now()->subMonth()->endOfMonth()->toDateString();
    //     } elseif ($filter == 'last_week') {
    //         $startDate = Carbon::now()->subWeek()->startOfWeek()->toDateString();
    //         $endDate = Carbon::now()->subWeek()->endOfWeek()->toDateString();
    //     } elseif ($filter == 'last_year') {
    //         $startDate = Carbon::now()->subYear()->startOfYear()->toDateString();
    //         $endDate = Carbon::now()->subYear()->endOfYear()->toDateString();
    //     } else {
    //         // If user selects a custom range
    //         if ($request->has('start_date') && $request->has('end_date')) {
    //             $startDate = $request->input('start_date');
    //             $endDate = $request->input('end_date');
    //         }
    //     }

    //     // Query sales within selected date range
    //     $sales = Sell::whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
    //         ->select(DB::raw('DATE(created_at) as date, SUM(grand_total) as total_sales'))
    //         ->groupBy(DB::raw('DATE(created_at)'))
    //         ->orderBy('date', 'asc')
    //         ->get();

    //     // Calculate total revenue for the selected period
    //     $totalSales = $sales->sum('total_sales');

    //     return view('backend.report.index', compact('sales', 'totalSales', 'startDate', 'endDate', 'filter'));
    // }

    public function report(Request $request)
    {
        $filter = $request->input('filter');
    
        // Default: Last 30 days (Today Backwards)
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();
    
        if ($filter == 'last_month') {
            $startDate = Carbon::now()->subMonth()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->toDateString();
        } elseif ($filter == 'last_week') {
            $startDate = Carbon::now()->subWeek()->startOfWeek()->toDateString();
            $endDate = Carbon::now()->toDateString();
        } elseif ($filter == 'last_year') {
            $startDate = Carbon::now()->subYear()->startOfYear()->toDateString();
            $endDate = Carbon::now()->toDateString();
        } else {
            if ($request->has('start_date') && $request->has('end_date')) {
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
    
                // Prevent End Date from being before Start Date
                if ($endDate < $startDate) {
                    return redirect()->route('report.index')
                        ->with('error', 'End date cannot be before the start date.');
                }
            }
        }
    
        // Query sales within selected date range
        $sales = Sell::whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date, SUM(grand_total) as total_sales'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();
    
        $totalSales = $sales->sum('total_sales');
    
        return view('backend.report.index', compact('sales', 'totalSales', 'startDate', 'endDate', 'filter'));
    }
    
}



