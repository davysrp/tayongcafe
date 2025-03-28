<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Webpage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class FrontendController extends Controller
{
    public function index(Request $request, $category = null)
    {
        $cart = Session::get('cart', []);
        $categories = Category::with(['products' => function ($query) {
            $query->where('status', 1)->with('productVariant'); 
        }])->get();

        $products = Product::where('status', 1)
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->with('productVariant') 
            ->get();
        $webpages = Webpage::where('status', 1)->get();

        return view('frontend.index', compact('categories', 'products', 'webpages', 'cart'));
    }

    public function __invoke()
    {

        $categories = Category::with(['products' => function ($query) {
            $query->where('status', 1)->with('productVariant'); 
        }])->get();

        $products = Product::where('status', 1)->with('productVariant')->get();

        return view('frontend.index', compact('categories', 'products'));
    }

    /**
     * Handle AJAX request to add a product to the cart.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


  
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id',
        ]);
    
        $product = Product::findOrFail($request->input('product_id'));
        $variant = $request->input('variant_id') ? ProductVariant::find($request->input('variant_id')) : null;
    
        $cart = session()->get('cart', []);
    
        $cartItem = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $variant ? $variant->variant_price : $product->price,
            'quantity' => $request->input('quantity'),
            'photo' => $product->photo,
            'variant_id' => $variant ? $variant->id : null,
            'variant_name' => $variant ? $variant->variant_name : null,
        ];
    
        $cart[] = $cartItem;
        session()->put('cart', $cart);
    
        return response()->json([
            'success' => true,
            // 'message' => 'Product added to cart successfully!',
            'message' => 'ទំនិញបានដាក់ចូលកន្រ្តកជោគជ័យ',
            'cart' => $cart,
        ]);
    }
    
    // public function updateCart(Request $request)
    // {
    //     $cart = session()->get('cart', []);
    
    //     if (!isset($cart[$request->id])) {
    //         return response()->json(['success' => false, 'message' => 'Product not found in cart']);
    //     }
    
    //     $cart[$request->id]['quantity'] = $request->quantity;
    //     session()->put('cart', $cart);
    
    //     $newSubtotal = $cart[$request->id]['price'] * $cart[$request->id]['quantity'];
    //     $newTotal = collect($cart)->sum(function ($item) {
    //         return $item['price'] * $item['quantity'];
    //     });
    
    //     return response()->json([
    //         'success' => true,
    //         'newSubtotal' => $newSubtotal,
    //         'newTotal' => $newTotal,
    //     ]);
    // }
    
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
    
        if (!isset($cart[$request->id])) {
            return response()->json(['success' => false, 'message' => 'Product not found in cart']);
        }
    
        $cart[$request->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
    
        $newSubtotal = $cart[$request->id]['price'] * $cart[$request->id]['quantity'];
        $newTotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    
        return response()->json([
            'success' => true,
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ]);
    }
        
    
    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
    
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
    
            $newTotal = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });
    
            return response()->json([
                'success' => true,
                'newTotal' => $newTotal,
            ]);
        }
    
        return response()->json(['success' => false, 'message' => 'Product not found']);
    }
    



}
