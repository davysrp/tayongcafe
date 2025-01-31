<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $sell->invoice_no }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; max-width: 800px; margin: auto; padding: 20px; }
        .header { text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f4f4f4; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Invoice</h2>
            <p>Invoice No: <strong>{{ $sell->invoice_no }}</strong></p>
            <p>Date: <strong>{{ $sell->created_at ? $sell->created_at->format('d-m-Y') : 'N/A' }}</strong></p>
            <p>Customer: <strong>{{ $sell->customer ? $sell->customer->first_name . ' ' . $sell->customer->last_name : 'N/A' }}</strong></p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sell->sellDetail as $key => $detail)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $detail->product ? $detail->product->names : 'N/A' }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>${{ number_format($detail->price, 2) }}</td>
                        <td>${{ number_format($detail->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>Subtotal: <strong>${{ number_format($sell->sub_total ?? 0, 2) }}</strong></p>
            <p>Discount: <strong>${{ number_format($sell->discount ?? 0, 2) }}</strong></p>
            <p><strong>Grand Total: ${{ number_format($sell->grand_total ?? 0, 2) }}</strong></p>
        </div>
    </div>
</body>
</html>
