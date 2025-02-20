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
        // Retrieve the cart from the session (default to empty array if not found)
        $cart = Session::get('cart', []);

        // Fetch categories with their active products and variants
        $categories = Category::with(['products' => function ($query) {
            $query->where('status', 1)->with('variants'); // Only active products with variants
        }])->get();

        // Fetch products based on category if provided, along with their variants
        $products = Product::where('status', 1)
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category); // Filter products by category
            })
            ->with('variants') // Eager load variants for products
            ->get();

        // Fetch webpages with status = 1 (active webpages)
        $webpages = Webpage::where('status', 1)->get();

        // Return the frontend.index view with the necessary data
        return view('frontend.index', compact('categories', 'products', 'webpages', 'cart'));
    }



    public function __invoke()
    {
        // Fetch categories and products with variants
        $categories = Category::with(['products' => function ($query) {
            $query->where('status', 1)->with('variants'); // Only active products and their variants
        }])->get();

        $products = Product::where('status', 1)->with('variants')->get();

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
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:variants,id', // Optional variant ID
        ]);

        // Get the product and variant (if applicable)
        $product = Product::findOrFail($request->input('product_id'));
        $variant = $request->input('variant_id') ? ProductVariant::find($request->input('variant_id')) : null;

        // Add the product to the cart (you can use session or a package like Laravel Cart)
        $cart = session()->get('cart', []);

        $cartItem = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $variant ? $variant->price : $product->price,
            'quantity' => $request->input('quantity'),
            'photo' => $product->photo,
            'variant_id' => $variant ? $variant->id : null,
            'variant_name' => $variant ? $variant->name : null,
        ];

        // Add the item to the cart
        $cart[] = $cartItem;
        session()->put('cart', $cart);

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cart' => $cart,
        ]);
    }
}
