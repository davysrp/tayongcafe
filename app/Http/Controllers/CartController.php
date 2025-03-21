<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\CouponCode;

class CartController extends Controller
{
    // Add a product to the cart
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $variantId = $request->input('variant_id'); // Optional, for product variants

        // Fetch product details from the database
        $product = Product::findOrFail($productId);

        // Check if the product has variants
        if ($variantId) {
            $variant = ProductVariant::findOrFail($variantId);
            $price = $variant->variant_price;
            $name = $product->names . ' - ' . $variant->variant_name;
        } else {
            $price = $product->price;
            $name = $product->names;
        }

        // Add the product to the cart session
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            // If the product already exists in the cart, update the quantity
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Add a new product to the cart
            $cart[$productId] = [
                'product_id' => $productId,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'photo' => $product->photo,
                'variant_id' => $variantId, // Optional, for product variants
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Update the cart (e.g., change quantity)
    public function updateCart(Request $request)
    {
        $productId = $request->input('id');
        $quantity = $request->input('quantity');

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    // Remove a product from the cart
    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    // Apply a coupon code
    public function applyCouponCode(Request $request)
    {
        $couponCode = $request->input('coupon_code');

        // Validate and apply the coupon code (you can add your logic here)
        // For example, check if the coupon code exists and is valid
        $discount = 0; // Default discount
        $coupon = CouponCode::where('code', $couponCode)->first();

        if ($coupon) {
            $discount = $coupon->discount; // Apply the discount
        }

        // Store the discount in the session
        Session::put('coupon', [
            'code' => $couponCode,
            'discount' => $discount,
        ]);

        return redirect()->back()->with('success', 'Coupon applied!');
    }

    // Clear the cart
    public function clearCart()
    {
        Session::forget('cart');
        Session::forget('coupon');

        return redirect()->back()->with('success', 'Cart cleared!');
    }

}
