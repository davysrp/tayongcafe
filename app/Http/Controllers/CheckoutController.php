<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    
    // Display the checkout page
    public function index()
    {
        // Get cart data from the session
        $cart = session('cart', []);

        // Calculate the total price
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Pass cart data and total to the view
        return view('frontend.checkout.index', [
            'cart' => $cart,
            'total' => $total,
        ]);
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
        $order = Auth::user()->orders()->create([
            'total_amount' => $total,
            'status' => 'pending',
            'shipping_address' => $request->input('address'),
            'payment_method' => $request->input('payment_method'),
        ]);

        // Add order items to the database
        foreach ($cart as $id => $item) {
            $order->items()->create([
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'variant_name' => $item['variant_name'] ?? null,
                'variant_size' => $item['variant_size'] ?? null,
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
}
