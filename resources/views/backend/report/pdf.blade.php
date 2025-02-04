<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .header { margin-bottom: 20px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Sales Report</h2>
        <p><strong>From:</strong> {{ $startDate }} - <strong>To:</strong> {{ $endDate }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Total Sales ($)</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1; @endphp
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                    <td>${{ number_format($sale->total_sales, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" style="text-align:right;">Grand Total:</th>
                <th>${{ number_format($totalSales, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <p style="text-align: right; margin-top: 20px;">
        <strong>Date Printed:</strong> {{ now()->format('d M Y H:i:s') }}
    </p>

</body>
</html>
