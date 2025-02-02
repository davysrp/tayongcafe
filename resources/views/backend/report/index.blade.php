{{-- <x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Report') }}
        </h2>
    </x-slot>

    <div class="container">
        <!-- Display Error Message -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row mb-4">
            <!-- Quick Filter Buttons -->
            <div class="col-md-12">
                <a href="{{ route('report.index', ['filter' => 'last_month']) }}" class="btn btn-secondary {{ $filter == 'last_month' ? 'active' : '' }}">Last Month</a>
                <a href="{{ route('report.index', ['filter' => 'last_week']) }}" class="btn btn-secondary {{ $filter == 'last_week' ? 'active' : '' }}">Last Week</a>
                <a href="{{ route('report.index', ['filter' => 'last_year']) }}" class="btn btn-secondary {{ $filter == 'last_year' ? 'active' : '' }}">Last Year</a>
                <a href="{{ route('report.index') }}" class="btn btn-primary">Reset</a>
            </div>
        </div>

        <div class="row mb-4">
            <!-- Filter Form -->
            <div class="col-md-6">
                <form action="{{ route('report.index') }}" method="GET" class="form-inline" id="filter-form">
                    <div class="form-group mr-2">
                        <label for="start_date" class="mr-2">From Date:</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="form-control">
                    </div>
                    <div class="form-group mr-2">
                        <label for="end_date" class="mr-2">End Date:</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>

        <!-- Sales Report Table -->
        <div class="card">
            <div class="card-header">
                <h4>Sales Report ({{ $startDate }} - {{ $endDate }})</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total Sales ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ $sale->date }}</td>
                                <td>${{ number_format($sale->total_sales, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No sales found for selected period.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total:</th>
                            <th>${{ number_format($totalSales, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("filter-form").addEventListener("submit", function (event) {
            let startDate = document.getElementById("start_date").value;
            let endDate = document.getElementById("end_date").value;

            if (endDate < startDate) {
                alert("End date cannot be before the start date.");
                event.preventDefault(); // Prevent form submission
            }
        });
    });
    </script>

</x-admin-layout> --}}



<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Report') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <!-- Display Error Message -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Report Header -->
        <div class="text-center mb-4">
            <h2 class="font-semibold text-2xl">Sales Report</h2>
            <p class="text-lg">Registered on: <strong>{{ $startDate }}</strong> to <strong>{{ $endDate }}</strong></p>
        </div>

        <!-- Quick Filter Buttons -->
        <div class="row mb-4">

            <div class="col-md-12 text-center">


                <a href="{{ route('report.index', ['filter' => 'last_week']) }}" class="btn btn-secondary {{ $filter == 'last_week' ? 'active' : '' }}">Last Week</a>
{{-- 
            <div class="col-md-12 text-center"> --}}

                <a href="{{ route('report.index', ['filter' => 'last_month']) }}" class="btn btn-secondary {{ $filter == 'last_month' ? 'active' : '' }}">Last Month</a>

                {{-- <a href="{{ route('report.index', ['filter' => 'last_week']) }}" class="btn btn-secondary {{ $filter == 'last_week' ? 'active' : '' }}">Last Week</a> --}}

                <a href="{{ route('report.index', ['filter' => 'last_year']) }}" class="btn btn-secondary {{ $filter == 'last_year' ? 'active' : '' }}">Last Year</a>
                <a href="{{ route('report.index') }}" class="btn btn-primary">Reset</a>

            </div>
        </div>

        <!-- Filter Form -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('report.index') }}" method="GET" class="form-inline text-center" id="filter-form">
                    <div class="form-group mr-2">
                        <label for="start_date" class="mr-2">From Date:</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="form-control">
                    </div>
                    <div class="form-group mr-2">
                        <label for="end_date" class="mr-2">End Date:</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>

        <!-- Sales Report Table -->
        <div class="card">
            <div class="card-header bg-dark text-white text-center">
                <h4>Sales Report ({{ $startDate }} - {{ $endDate }})</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Total Sales ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                                <td>${{ number_format($sale->total_sales, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No sales found for selected period.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-dark text-white">
                        <tr>
                            <th colspan="2" class="text-right">Grand Total:</th>
                            <th>${{ number_format($totalSales, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Report Footer -->
        <div class="mt-4 text-right">
            <p><strong>Date Printed:</strong> {{ now()->format('d M Y H:i:s') }}</p>
            <p>Page 1 of 1</p>
        </div>
    </div>

    <!-- JavaScript Validation -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("filter-form").addEventListener("submit", function (event) {
            let startDate = document.getElementById("start_date").value;
            let endDate = document.getElementById("end_date").value;

            if (endDate < startDate) {
                alert("End date cannot be before the start date.");
                event.preventDefault(); // Prevent form submission
            }
        });
    });

    <div class="row mb-4">
    <div class="col-md-12 text-center">
        <a href="{{ route('report.export.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-danger">
            Download PDF
        </a>
    </div>
</div>

    </script>

</x-admin-layout>

