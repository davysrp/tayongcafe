<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        @font-face {
            font-family: 'KhmerOSBattambang';
            src: url('{{ storage_path("fonts/KhmerOSBattambang-Regular.ttf") }}') format('truetype');
        }
        @font-face {
            font-family: 'Siemreap';
            src: url('{{ storage_path("fonts/Siemreap-Regular.ttf") }}') format('truetype');
        }
        @font-face {
            font-family: 'Roboto';
            src: url('{{ storage_path("fonts/Roboto-Regular.ttf") }}') format('truetype');
        }

        body {
            font-family: 'KhmerOSBattambang', 'Siemreap', 'Roboto', sans-serif;
            font-size: 14px;
            text-align: center;
            width: 100%;
            margin: 0 auto;
            padding: 10px;
            height: auto;
        }
        h2 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .store-info {
            font-size: 12px;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        th, td {
            font-size: 13px;
            border-bottom: 1px dashed black;
            padding: 4px;
            text-align: left;
            white-space: normal;
            word-wrap: break-word;
            overflow: hidden;
            font-family: 'KhmerOSBattambang', 'Siemreap', sans-serif; /* ✅ Apply Khmer font */
        }
        th {
            font-weight: bold;
            text-align: center;
        }
        .total, .payment {
            font-size: 14px;
            font-weight: bold;
            text-align: right;
            margin-top: 5px;
        }
        .thanks {
            margin-top: 10px;
            font-size: 12px;
            font-style: italic;
        }
        .divider {
            border-top: 1px solid black;
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <h2>TANYONG BBU-BMC.</h2>
    <p class="store-info">
        Sereisophoan City, Banteay Meanchey Province.<br>
        Phone: +855 93 444 498<br>
        Date: {{ $sell->created_at ? $sell->created_at->format('d-m-Y h:i A') : 'N/A' }}
    </p>
    <p><strong>Queue No:</strong> {{ $queueNumber ?? 'N/A' }}</p>
    <div class="divider"></div>

    <p><strong>Invoice <span style="font-family: DejaVu Sans;">№</span>: </strong> {{ $sell->invoice_no ?? 'N/A' }}</p>
    <p><strong>Customer:</strong> {{ $sell->customer ? $sell->customer->first_name . ' ' . $sell->customer->last_name : 'Guest' }}</p>

    <div class="divider"></div>

    <table>
        <thead>
            <tr>
                <th style="width: 40%;">Item</th>
                <th style="width: 15%; text-align: center;">Qty</th>
                <th style="width: 20%; text-align: right;">Price</th>
                <th style="width: 25%; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sell->sellDetail as $detail)
            <tr>
                <td>
                    <span style="font-family: 'KhmerOSBattambang';">
                        {{ $detail->product ? $detail->product->names : 'Unknown' }}
                        {!! $detail->productVariant->variant_name ?? '' !!}
                    </span>
                </td>
                <td style="text-align: center;">{{ $detail->qty ?? 1 }}</td>
                <td style="text-align: right;">${{ number_format($detail->price ?? 0, 2) }}</td>
                <td style="text-align: right;">${{ number_format(($detail->qty ?? 1) * ($detail->price ?? 0), 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="divider"></div>

    <p class="total">Subtotal: ${{ number_format($sell->total ?? 0, 2) }}</p>
    <p class="total">Discount: ${{ number_format($sell->discount ?? 0, 2) }}</p>
    <p class="total"><strong>Grand Total: ${{ number_format($sell->grand_total ?? 0, 2) }}</strong></p>

    {{-- <p class="payment">Paid by: {{ $sell->payment_method_id ? 'Cash' : 'N/A' }}</p> --}}

    <p class="payment">Paid by: {{ $sell->paymentMethod->names ?  : 'N/A' }}</p>

    <div class="divider"></div>

    <p class="thanks">Thank you for shopping with us! <br> Please visit again.</p>

</body>
</html>
