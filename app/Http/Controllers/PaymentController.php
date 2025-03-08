<?php

namespace App\Http\Controllers;
use App\Models\Sell;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
 

    public function confirmPayment(Request $request)
    {
        $orderId = $request->order_id;
    
        if (!$orderId) {
            return redirect()->back()->with('error', 'Invalid order ID');
        }
    
        $sell = Sell::findOrFail($orderId);
        $sell->status = 'paid';
        $sell->save();
    
        return redirect()->back()->with([
            'payment_success' => true,
            'order_id' => $orderId,
            'invoice_view' => route('invoice.view', $sell->id),
            'invoice_download' => route('invoice.download', $sell->id),
        ]);
    }
        
    
}
