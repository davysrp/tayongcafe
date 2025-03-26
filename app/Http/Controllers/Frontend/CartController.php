<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;




class CartController extends Controller
{
    // Display the cart page
    public function index()
    {
      
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $paymentMethods=PaymentMethod::all();

        return view('frontend.cart.index', compact('cart', 'paymentMethods','total'));
    }

    // Add a product to the cart
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        $variantId = $request->input('variant_id');
        $variant = $variantId ? ProductVariant::findOrFail($variantId) : null;

        $cart = session()->get('cart', []);

        // Unique key for the cart item
        $cartKey = $variantId ? "{$productId}-{$variantId}" : $productId;

        $productName = $product->names;
        if ($variant) $productName .='-'. $variant->variant_name;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                "name" => $productName,
                "product_id" => $productId,
                "quantity" => 1,
                "price" => $variant ? $variant->variant_price : $product->price,
                "photo" => $product->photo,
                "variant_id" => $variantId,
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }


    // Update the cart
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
        $id = $request->input('id');
        $quantity = $request->input('quantity');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            // Calculate the new subtotal for this item
            $newSubtotal = $cart[$id]['price'] * $quantity;
            // Recalculate total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            return response()->json([
                'success' => true,
                'newSubtotal' => $newSubtotal,
                'newTotal' => $total
            ]);
        }

        return response()->json(['success' => false]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart');
        $id = $request->input('id');

        \Log::info('Removing item from cart:', ['id' => $id, 'cart' => $cart]); // Debugging

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            // Recalculate total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            \Log::info('Cart after removal:', $cart); // Debugging

            return response()->json([
                'success' => true,
                'newTotal' => $total
            ]);
        }

        \Log::error('Item not found in cart:', ['id' => $id]); // Debugging
        return response()->json(['success' => false]);
    }


    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id'); // null if no variant

        $cart = session()->get('cart', []);

        \Log::info('Removing product', [
            'product_id' => $productId,
            'variant_id' => $variantId,
        ]);


        foreach ($cart as $index => $item) {
            if ($item['id'] == $productId) {
                // Check variant if you have variants
                if (!empty($variantId) && isset($item['variant_id']) && $item['variant_id'] != $variantId) {
                    continue;
                }

                unset($cart[$index]);
                break;
            }
        }

        session()->put('cart', $cart);

        $newTotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return response()->json([
            'success' => true,
            'newTotal' => number_format($newTotal, 2),
        ]);
    }




}
