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
            'cart',
            'total',
            'shippingMethods',
            'paymentMethods',
            'customer'
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
            'shipping_method_id' => $request->shipping_method_id,
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



    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');

        // Handle quantity whether it comes as array or direct value
        $quantityInput = $request->input('quantity');
        $quantity = is_array($quantityInput) ? (int)($quantityInput[$id] ?? 1) : (int)$quantityInput;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);

            $price = (float)$cart[$id]['price'];
            $newSubtotal = $price * $quantity;

            // Calculate total safely
            $total = 0;
            foreach ($cart as $item) {
                $itemPrice = (float)($item['price'] ?? 0);
                $itemQty = (int)($item['quantity'] ?? 0);
                $total += $itemPrice * $itemQty;
            }

            return response()->json([
                'success' => true,
                'newSubtotal' => number_format($newSubtotal, 2),
                'newTotal' => number_format($total, 2),
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found']);
    }


    public function removeFromCart(Request $request)
    {
        try {
            $request->validate(['id' => 'required|string']);

            $cart = session()->get('cart', []);
            $id = $request->id;

            if (!isset($cart[$id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found in cart'
                ], 404);
            }

            unset($cart[$id]);
            session()->put('cart', $cart);

            $newTotal = array_reduce($cart, function ($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);

            return response()->json([
                'success' => true,
                'newTotal' => number_format($newTotal, 2),
                'cartCount' => count($cart)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkTransactionOrder(Request $request)
    {
        if ($request->payment_method_id == 1) {
            $model = PaymentMethod::find($request->payment_method_id);
            $reqs = \Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $model->token
            ])->post('https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5', [
                'md5' => $request->md5
            ]);
            if ($reqs->failed()) {
            }
            $data = json_decode($reqs->body());


            if ($data->responseCode === 0) {
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
                    'shipping_method_id' => $request->shipping_method_id,
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
                $this->telegramNotification($request);
                return [
                    'success' => true,
                    'message' => true,
                    'data' => $order,
                ];
            } elseif ($data->responseCode == 1 && $data->errorCode == 6) {
                $req = \Http::post('https://api-bakong.nbc.gov.kh/v1/renew_token', [
                    'email' => 'phansophat2020@gmail.com'
                ]);
                $tokenData = json_decode($req->body());
                $model->update(['token' => $tokenData->data->token]);
            }
        } else {
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
                'shipping_method_id' => $request->shipping_method_id,
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
            $this->telegramNotification($request);
            return [
                'success' => true,
                'message' => true,
                'data' => $order,
            ];
        }


        return $request->all();
    }
    public function telegramNotification(Request $request)
    {
        try {
            $apiToken = env('TELEGRAM_BOT_TOKEN');
            $text = '🚀 Payment Successful! Your order is confirmed.';

            $response = \Http::get("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=" . env('TELEGRAM_CHAT_CHANEL') . '&text=' . $text);

            return $response->body();
        } catch (\Exception $exception) {
            return response()->json([
                'statusCode' => 200,
                'message' => 'Failed Notification',
                'success' => false,
                'data' => []
            ]);
        }
    }
}
