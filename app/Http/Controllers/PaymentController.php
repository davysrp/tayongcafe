<?php

namespace App\Http\Controllers;
use App\Models\Sell;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
 

    // public function confirmPayment(Request $request)
    // {
    //     $orderId = $request->order_id;
    
    //     if (!$orderId) {
    //         return redirect()->back()->with('error', 'Invalid order ID');
    //     }
    
    //     // Simulate Payment Success (Replace with actual payment gateway logic)
    //     $sell = Sell::findOrFail($orderId);
    //     $sell->status = 'paid';
    //     $sell->save();
    
    //     return redirect()->back()->with([
    //         'payment_success' => true,
    //         'order_id' => $orderId,
    //         'invoice_view' => route('invoice.view', $sell->id),
    //         'invoice_download' => route('invoice.download', $sell->id),
    //     ]);
    // }
        
    public function confirmPayment(Request $request)
    {
        $orderId = $request->order_id;
    
        if (!$orderId) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid order ID'
            ]);
        }
    
        // Simulate Payment Success (Replace with actual payment gateway logic)
        $sell = Sell::findOrFail($orderId);
        $sell->status = 'paid';
        $sell->save();
    
        // Format order details
        $invoiceData = [
            'success' => true,
            'message' => 'Payment Successful!',
            'date' => $sell->created_at->format('d-m-Y h:i A'),
            'invoice_no' => $sell->invoice_no ?? 'N/A',
            'customer' => $sell->customer ? $sell->customer->first_name . ' ' . $sell->customer->last_name : 'Guest',
            'items' => $sell->sellDetail->map(function ($item) {
                return [
                    'name' => $item->product ? $item->product->names : 'Unknown',
                    'qty' => $item->qty ?? 1,
                    'price' => number_format($item->price ?? 0, 2),
                    'total' => number_format(($item->qty ?? 1) * ($item->price ?? 0), 2),
                ];
            })->toArray(),
            'subtotal' => number_format($sell->total ?? 0, 2),
            'discount' => number_format($sell->discount ?? 0, 2),
            'grand_total' => number_format($sell->grand_total ?? 0, 2),
            'payment_method' => $sell->payment_method_id ? 'Cash' : 'N/A',
            'invoice_download' => route('invoice.download', $sell->id),
        ];
    
        return response()->json($invoiceData);
    }
    
    
}
