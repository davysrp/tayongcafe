<x-app-layout>


    {{-- <div class="container">
        <h1>Order Placed Successfully!</h1>
        <p>Thank you for your purchase. Your order has been placed successfully.</p>
       
    </div> --}}


 <div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow border-0">
                <div class="card-body">

                    <div class="text-center mb-4">
                        <h4 class="text-success fw-bold">✅ Order Placed Successfully!</h4>
                        <p class="text-muted">Thank you for your purchase.</p>
                    </div>

@if($order)
    <style>
        .invoice-box {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            color: #333;
            padding: 20px;
            border: 1px solid #ccc;
            background: #fff;
            border-radius: 8px;
        }
        .invoice-box h6 {
            margin-bottom: 15px;
            font-size: 16px;
            color: #0d6efd;
        }
        .invoice-box table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .invoice-box table th,
        .invoice-box table td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .invoice-box table th {
            background-color: #f2f2f2;
            font-weight: 600;
        }
        .invoice-summary {
            margin-top: 20px;
        }
        .invoice-summary div {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        .invoice-summary strong {
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }
        .action-buttons a,
        .action-buttons button {
            background-color: #0d6efd;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .action-buttons a:hover,
        .action-buttons button:hover {
            background-color: #0b5ed7;
        }
    </style>

    <div class="invoice-box" id="invoice">
        <h6>🧾 Invoice Details</h6>
        <p><strong>Date:</strong> {{ $order->created_at->format('d-m-Y h:i A') }}</p>
        <p><strong>Queue No:</strong> {{ $order->q_number ?? '-' }}</p>
        <p><strong>Invoice №:</strong> {{ $order->invoice_no ?? 'N/A' }}</p>
        <p><strong>Customer:</strong> {{ $order->customer->first_name ?? 'Guest' }} {{ $order->customer->last_name ?? '' }}</p>
        {{-- <p><strong>Shipping Method:</strong> {{ $order->shippingMethod->name ?? 'N/A' }}</p> --}}

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp
                @foreach($order->sellDetail as $item)
                    @php
                        $name = $item->product->names ?? 'Unknown';
                        $variant = $item->productVariant->variant_name ?? '';
                        $itemName = trim($name . ' ' . $variant);
                        $lineTotal = $item->price * $item->qty;
                        $subtotal += $lineTotal;
                    @endphp
                    <tr>
                        <td style="text-align: left">{{ $itemName }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>${{ number_format($lineTotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- @php
            $priceSession = session('price_cart');
            $discount = $priceSession['discount_price'] ?? 0;
            $grandTotal = $subtotal - $discount;
        @endphp --}}

        @php
            $discount = $order->discount ?? 0;
            $grandTotal = $order->grand_total ?? 0;
            $subtotal = $order->subtotal ?? 0;
        @endphp


        <div class="invoice-summary">
            <div><span><strong>Subtotal:</strong></span><span>${{ number_format($subtotal, 2) }}</span></div>
            <div><span><strong>Discount:</strong></span><span>${{ number_format($discount, 2) }}</span></div>
            <div><span><strong>Grand Total:</strong></span><span><strong>${{ number_format($grandTotal, 2) }}</strong></span></div>
            <div><span><strong>Paid by:</strong></span><span>{{ $order->paymentMethod->names ?? 'N/A' }}</span></div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ url('/') }}">🏠 Back to Home</a>
        <button onclick="printInvoice()">🖨️ Download Invoice</button>
    </div>

    <script>
        function printInvoice() {
            let invoiceContent = document.getElementById('invoice').innerHTML;
            let printWindow = window.open('', '', 'height=700,width=900');
            printWindow.document.write('<html><head><title>Invoice</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('body { font-family: Arial, sans-serif; padding: 20px; }');
            printWindow.document.write('.invoice-box { border: 1px solid #ccc; padding: 20px; border-radius: 8px; }');
            printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-top: 10px; }');
            printWindow.document.write('th, td { padding: 8px; border: 1px solid #ccc; text-align: center; }');
            printWindow.document.write('th { background-color: #f2f2f2; }');
            printWindow.document.write('.invoice-summary div { display: flex; justify-content: space-between; padding: 5px 0; }');
            printWindow.document.write('strong { font-weight: bold; }');
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(invoiceContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }
    </script>

@else
    <div class="alert alert-warning text-center">
        ⚠ No recent order found.
    </div>
@endif

                    <div class="text-center text-muted small mt-4">
                        &copy;{{ now()->year }} Tanyong Café. All Rights Reserved.
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




</x-app-layout>


