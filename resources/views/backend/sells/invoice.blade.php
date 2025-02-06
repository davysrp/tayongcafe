
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Invoice</title>
     <style>
         @font-face {
             font-family: 'NotoSansKhmer';
             src: url('{{ public_path('fonts/NotoSansKhmer-Regular.ttf') }}') format('truetype');
             font-weight: normal;
             font-style: normal;
         }
         @font-face {
             font-family: 'battambang';
             src: url('{{ public_path('fonts/KhmerOS_battambang.ttf') }}') format('truetype');
             font-weight: normal;
             font-style: normal;
         }

         body {
             margin: 5px;
             padding: 0;
             font-family: battambang;
             font-size: 11px; /* Optimized for thermal printers */
             text-align: center;
         }
         h2 { font-size: 14px; margin-bottom: 3px; }
         .store-info {
             font-size: 10px;
             margin-bottom: 5px;
         }
         table {
             width: 100%;
             border-collapse: collapse;
             margin-top: 5px;
         }
         th, td {
             border-bottom: 1px dashed black;
             padding: 3px;
         }
         th {
             font-size: 11px;
             font-weight: bold;
             text-align: center; /* Center headers */
             background: none;
         }
         .total, .payment {
             font-size: 12px;
             font-weight: bold;
             text-align: right;
             margin-top: 5px;
         }
         .thanks {
             margin-top: 10px;
             font-size: 11px;
             font-style: italic;
         }
         .divider {
             border-top: 1px solid black;
             margin: 5px 0;
         }
        @page {
            margin: 0 !important;
            padding: 0 !important;
        }

     </style>
 </head>
 <body>
     <!-- Store Info -->
     <h2>TANYONG BBU-BMC.</h2>
     <p class="store-info">
         Sereisophoan City, Banteay Meanchey Province.<br>
         Phone: +855 93 444 498<br>
         Date: {{ $sell->created_at ? $sell->created_at->format('d-m-Y h:i A') : 'N/A' }}
     </p>

     <div class="divider"></div>

     <!-- Invoice Info -->
     <p><strong>Invoice №:</strong> {{ $sell->invoice_no ?? 'N/A' }}</p>
     <p><strong>Customer:</strong>
         {{ $sell->customer ? $sell->customer->first_name . ' ' . $sell->customer->last_name : 'Guest' }}
     </p>

     <div class="divider"></div>

    <!-- Order Details -->
<table>
    <thead>
        <tr>
            <th style="width: 40%; text-align: left;">Item</th>
            <th style="width: 15%; text-align: center;">Qty</th>
            <th style="width: 20%; text-align: right;">Price</th>
            <th style="width: 25%; text-align: right;">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sell->sellDetail as $detail)
        <tr>
            <td style="text-align: left; font-family: 'battambang', sans-serif">
                {{ $detail->product ? $detail->product->names : 'Unknown' }}
                {!! $detail->productVariant->variant_name ?? null !!}
            </td>
            <td style="text-align: center;">
                {{ $detail->qty ?? 1 }}
            </td>
            <td style="text-align: right;">
                ${{ number_format($detail->price ?? 0, 2) }}
            </td>
            <td style="text-align: right;">
                ${{ number_format(($detail->qty ?? 1) * ($detail->price ?? 0), 2) }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


     <div class="divider"></div>

     <!-- Totals -->
     <p class="total">Subtotal: ${{ number_format($sell->total ?? 0, 2) }}</p>
     <p class="total">Discount: ${{ number_format($sell->discount ?? 0, 2) }}</p>
     <p class="total"><strong>Grand Total: ${{ number_format($sell->grand_total ?? 0, 2) }}</strong></p>

     <!-- Payment Method -->
     <p class="payment">Paid by: {{ $sell->payment_method_id ? 'Cash' : 'N/A' }}</p>

     <div class="divider"></div>

     <p class="thanks">Thank you for shopping with us! <br> Please visit again.</p>
 </body>
 </html>
