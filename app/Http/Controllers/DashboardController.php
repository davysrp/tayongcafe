<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\AccountRequest;
use App\Models\Sell;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $currentDate = Carbon::now();

        // $sales = Sell::query();
        // $saleByMonth = $sales->whereMonth('created_at', $currentDate->format('m'))->sum('grand_total');
        // $saleByYear = $sales->whereYear('created_at', $currentDate->format('Y'))->sum('grand_total');
        // $totalOrderByMonth = $sales->whereMonth('created_at', $currentDate->format('m'))->count();
        // $totalOrderYear = $sales->whereYear('created_at', $currentDate->format('Y'))->count();
        // $accountRequest = AccountRequest::whereStatus(0)->count();
        // return view('backend.dashboard',compact('saleByMonth','saleByYear','totalOrderByMonth','totalOrderYear','accountRequest'));
        
        // // Query for monthly sells
        // $monthlySells = Sell::select(DB::raw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(grand_total) as total_sales'))
        //     ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
        //     ->get();

        // // Total monthly sales grand_total
        // $totalMonthlySales = $monthlySells->sum('total_sales');

        // // Query for yearly sells
        // $yearlySells = Sell::select(DB::raw('YEAR(created_at) as year, SUM(grand_total) as total_sales'))
        //     ->groupBy(DB::raw('YEAR(created_at)'))
        //     ->get();

        // // Total yearly sales grand_total
        // $totalYearlySales = $yearlySells->sum('total_sales');

        // // Query for weekly sells
        // $weeklySells = Sell::select(DB::raw('WEEK(created_at) as week, YEAR(created_at) as year, SUM(grand_total) as total_sales'))
        //     ->groupBy(DB::raw('YEAR(created_at), WEEK(created_at)'))
        //     ->get();

        // // Total weekly sales grand_total
        // $totalWeeklySales = $weeklySells->sum('total_sales');

        // // Query for daily sells
        // $dailySells = Sell::select(DB::raw('DATE(created_at) as date, SUM(grand_total) as total_sales'))
        //     ->groupBy(DB::raw('DATE(created_at)'))
        //     ->get();

        // // Total daily sales grand_total
        // $totalDailySales = $dailySells->sum('total_sales');


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
}
