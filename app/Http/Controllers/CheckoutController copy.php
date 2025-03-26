<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\SellDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShippingMethod;

use App\Models\PaymentMethod;


class CheckoutController extends Controller
{

    // Display the checkout page
    // public function index()
    // {
    //     // Get cart data from the session
    //     $cart = session('cart', []);

    //     // Calculate the total price
    //     $total = 0;
    //     foreach ($cart as $item) {
    //         $total += $item['price'] * $item['quantity'];
    //     }

    //     // Pass cart data and total to the view
    //     return view('frontend.checkout.index', [
    //         'cart' => $cart,
    //         'total' => $total,
    //     ]);
    // }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    
        $shippingMethods = ShippingMethod::where('status', 'active')->get();
        $paymentMethods = PaymentMethod::where('status', 'active')->get();
    
        $customer = Auth::guard('customer')->user(); // logged in customer
    
        if (!$customer) {
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }
    
        return view('frontend.checkout.index', compact(
            'cart', 'total', 'shippingMethods', 'paymentMethods', 'customer'
        ));
    }
    


    // Process the checkout
    public function process(Request $request)
    {

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:credit_card,paypal,cash_on_delivery',
        ]);

        // Get cart data from the session
        $cart = session('cart', []);

        // Calculate the total price
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Save the order to the database (example logic)
        $order = Sell::create([
            'total_amount' => $total,
            'status' => 'pending',
            'shipping_address' => $request->input('address'),
            'payment_method' => $request->input('payment_method'),
        ]);

        // Add order items to the database
        foreach ($cart as $id => $item) {
            SellDetail::create([
                'sell_id' => $order->id,
                'product_id' => $item['product_id'],
                'qty' => $item['quantity'],
                'price' => (float)$item['price'],
                'total' => (float) $item['price'] *  (int)$item['quantity'],
                'product_variant_id' =>(int) $item['variant_id'],
            ]);
        }

        // Clear the cart session
        session()->forget('cart');

        // Redirect to a thank-you page or order confirmation page
        return redirect()->route('checkout.success')->with('success', 'Your order has been placed successfully!');
    }

    // Display the success page
    public function success()
    {
        return view('frontend.checkout.success');
    }



    
    // public function checkout()
    // {
    //     $cart = session()->get('cart', []);
    //     $total = array_sum(array_map(function($item) {
    //         return $item['price'] * $item['quantity'];
    //     }, $cart));
    
    //     $shipping_methods = ShippingMethod::where('status', 'active')->get();
    
    //     $customer = Auth::guard('customer')->user(); // assuming you're using 'customer' guard
    
    //     return view('frontend.checkout.index', compact('cart', 'total', 'shipping_methods', 'customer'));
    // }
    

    
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    
        $shipping_methods = ShippingMethod::where('status', 'active')->get();
        $customer = Auth::guard('customer')->user(); // assuming 'customer' guard
    
        return view('frontend.checkout.index', compact('cart', 'total', 'shipping_methods', 'customer'));
    }
    



    



}
