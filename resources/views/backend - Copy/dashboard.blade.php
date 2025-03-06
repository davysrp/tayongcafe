<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
    
        <div class="row">
            <!-- Earnings (Daily) -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Earnings (Daily)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ isset($totalDailySales) ? number_format($totalDailySales, 2) : '0.00' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Earnings (Weekly) -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Earnings (Weekly)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ isset($totalWeeklySales) ? number_format($totalWeeklySales, 2) : '0.00' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Earnings (Monthly) -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Earnings (Monthly)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ isset($totalMonthlySales) ? number_format($totalMonthlySales, 2) : '0.00' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    
            <!-- Earnings (Yearly) -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings (Annual)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ isset($totalYearlySales) ? number_format($totalYearlySales, 2) : '0.00' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>

</x-admin-layout>
