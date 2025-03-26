<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\SellDetail;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Show the checkout page
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $shippingMethods = ShippingMethod::where('status', 'active')->get();
        $paymentMethods = PaymentMethod::where('status', 'active')->get();

        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }

        return view('frontend.checkout.index', compact(
            'cart', 'total', 'shippingMethods', 'paymentMethods', 'customer'
        ));
    }

    // Handle order submission
    public function process(Request $request)
    {
        // Validate
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Save the order
        $order = Sell::create([
            'customer_id'       => $request->customer_id,
            'total_amount'      => $total,
            'status'            => 'pending',
            'shipping_method_id'=> $request->shipping_method_id,
            'payment_method_id' => $request->payment_method_id,
        ]);

        // Save order details
        foreach ($cart as $item) {
            SellDetail::create([
                'sell_id'            => $order->id,
                'product_id'         => $item['product_id'],
                'qty'                => $item['quantity'],
                'price'              => (float) $item['price'],
                'total'              => (float) $item['price'] * (int) $item['quantity'],
                'product_variant_id' => (int) $item['variant_id'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('checkout.success')->with('success', 'Your order has been placed successfully!');
    }

    // Show success message
    public function success()
    {

        
        return view('frontend.checkout.success');
    }
}
