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
            <p class="text-lg"><strong>From:</strong> {{ $startDate }} - <strong>To:</strong> {{ $endDate }}</p>
        </div>

        <!-- Quick Filter Buttons -->
        <div class="text-center mb-4">
            <a href="{{ route('report.index', ['filter' => 'last_week']) }}" class="btn btn-outline-secondary {{ $filter == 'last_week' ? 'active' : '' }}">Last Week</a>
            <a href="{{ route('report.index', ['filter' => 'last_month']) }}" class="btn btn-outline-secondary {{ $filter == 'last_month' ? 'active' : '' }}">Last Month</a>
            <a href="{{ route('report.index', ['filter' => 'last_year']) }}" class="btn btn-outline-secondary {{ $filter == 'last_year' ? 'active' : '' }}">Last Year</a>
            <a href="{{ route('report.index') }}" class="btn btn-outline-primary">Reset</a>
        </div>

        <!-- Filter Form -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('report.index') }}" method="GET" class="text-center" id="filter-form">
                    <div class="form-group">
                        <label for="start_date">From:</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="form-control d-inline-block w-auto">
                        
                        <label for="end_date" class="ml-2">To:</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="form-control d-inline-block w-auto">
                        
                        <button type="submit" class="btn btn-primary ml-2">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Download PDF Button -->
        <div class="text-center mb-4">
            <a href="{{ route('report.export.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
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
                                <td colspan="3" class="text-center text-muted">No sales found for selected period.</td>
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
                    event.preventDefault();
                }
            });
        });
    </script>

</x-admin-layout>
