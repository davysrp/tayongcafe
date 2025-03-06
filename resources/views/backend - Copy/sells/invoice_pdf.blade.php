<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-box { width: 100%; border: 1px solid #ddd; padding: 20px; }
        .header { text-align: center; font-size: 20px; font-weight: bold; }
        .info-table, .product-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .info-table td, .product-table th, .product-table td { border: 1px solid #ddd; padding: 8px; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">Invoice #{{ $sell->id }}</div>
        <table class="info-table">
            <tr>
                <td><strong>Customer:</strong> {{ $sell->customer->full_name ?? 'General Customer' }}</td>
                <td class="text-right"><strong>Date:</strong> {{ $sell->created_at->format('d-m-Y') }}</td>
            </tr>
        </table>
        <table class="product-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sell->sellDetail as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->price, 2) }}</td>
                        <td>{{ number_format($detail->quantity * $detail->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <strong>Total: {{ number_format($sell->sellDetail->sum(fn($d) => $d->quantity * $d->price), 2) }}</strong>
        </div>
    </div>
</body>
</html>
