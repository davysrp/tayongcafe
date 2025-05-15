<?php

namespace App\Http\Controllers;

use App\Models\CouponCode;
use App\Models\Sell;
use App\Models\SellDetail;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
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

        return view('frontend.cart.index', compact(
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
        session()->put('last_order_id', $order->id); // ✅ ADD THIS


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

        session()->put('last_order_id', $order->id);


        return redirect()->route('checkout.success')->with('success', 'Your order has been placed successfully!');
    }

    // Show success message
    // public function success()
    // {
    //     return view('frontend.checkout.Success');
    // }


    // Working .......
    // public function success()
    // {
    //     $orderId = session()->get('last_order_id');
    //     $order = Sell::with(['sellDetail.product', 'sellDetail.productVariant'])->find($orderId);

    //     return view('frontend.checkout.success', compact('order'));
    // }


    public function success()
    {
        $orderId = session()->get('last_order_id');
        $order = null;
        $shippingMethods = [];

        if ($orderId) {
            $order = Sell::with([
                'sellDetail.product',
                'sellDetail.productVariant',
                'customer',
                'paymentMethod',
                'shippingMethod' // make sure this relation exists
                
            ])->find($orderId);

            $shippingMethods = ShippingMethod::where('status', 'active')->get();

            // Calculate subtotal and discount as before
            $subtotal = 0;
            foreach ($order->sellDetail as $item) {
                $subtotal += $item->price * $item->qty;
            }

            $priceSession = session('price_cart');
            $discount = $priceSession['discount_price'] ?? 0;
            $grandTotal = $subtotal - $discount;

            $order->subtotal = $subtotal;
            $order->discount = $discount;
            $order->grand_total = $grandTotal;

            session()->forget([
                'cart',
                'price_cart',
                'coupon_code',
                'last_order_id',
            ]);
        }

        return view('frontend.checkout.success', compact('order', 'shippingMethods'));
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
        $customer_id = Auth::guard()->user()->id;
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
                    'customer_id'       => $customer_id,
                    'total_amount'      => $total,
                    'status'            => 'pending',
                    'shipping_method_id' => $request->shipping_method_id,
                    'payment_method_id' => $request->payment_method_id,
                    
                ]);
                session()->put('last_order_id', $order->id); // ✅ ADD THIS


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
                // $this->telegramNotification($request);
                $this->telegramNotification($order);

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
                'customer_id'       => $customer_id,
                'total_amount'      => $total,
                'status'            => 'pending',
                'shipping_method_id' => $request->shipping_method_id,
                'payment_method_id' => $request->payment_method_id,
            ]);
            session()->put('last_order_id', $order->id); // ✅ ADD THIS


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
            //$this->telegramNotification($request);
            $this->telegramNotification($order);

            return [
                'success' => true,
                'message' => true,
                'data' => $order,
            ];
        }


        return $request->all();
    }

    public function applyCouponCode(Request $request)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $coupon = CouponCode::where('coupon_code', $request->coupon_code)
            ->whereDate('start_date', '<=', $currentDate)
            ->whereDate('expired_date', '>=', $currentDate)->whereStatus(1)->first();

        if ($coupon) {
            $cart = session()->get('cart');
            $total = 0;
            foreach ($cart as $item) {
                $itemTotal = $item['quantity'] * $item['price'];
                $total = $total + $itemTotal;
            }
            $discountPrice = ($total * ($coupon->percentage / 100));
            if ($discountPrice > $coupon->discount_cap) {
                $discountPrice = $coupon->discount_cap;
            }

            $grandTotal = $total - $discountPrice;

            $price = session()->get('price_cart');
            if (!$price) {
                session()->put('price_cart', [
                    'grand_total' => $grandTotal,
                    'discount_price' => $discountPrice,
                    'coupon_code' => $request->coupon_code,
                    'coupon_id' => $coupon->id
                ]);
            }

            return redirect()->back()->with('success', 'Coupon Code apply successful!');
        }

        return redirect()->back()->with('error', 'Coupon Code is invalid!');
    }
    // public function telegramNotification(Request $request)
    // {
    //     try {
    //         $apiToken = env('TELEGRAM_BOT_TOKEN');
    //         $text = '🚀 Payment Successful! Your order is confirmed.';

    //         $response = \Http::get("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=" . env('TELEGRAM_CHAT_CHANEL') . '&text=' . $text);

    //         return $response->body();
    //     } catch (\Exception $exception) {
    //         return response()->json([
    //             'statusCode' => 200,
    //             'message' => 'Failed Notification',
    //             'success' => false,
    //             'data' => []
    //         ]);
    //     }
    // }


    public function telegramNotification($order)
    {
        try {
            $sell = Sell::with(['sellDetail.product', 'sellDetail.productVariant', 'customer', 'paymentMethod','shippingMethod'])->find($order->id);

            if (!$sell) return;

            if (!$sell->invoice_no) {
                $sell->invoice_no = 'INV-' . str_pad($sell->id, 6, '0', STR_PAD_LEFT);
                $sell->save();
            }

            $salesForTheDay = Sell::whereDate('created_at', $sell->created_at->toDateString())
                ->orderBy('created_at', 'asc')->get();

            $queueNumber = 1;
            foreach ($salesForTheDay as $index => $sale) {
                if ($sale->id == $sell->id) {
                    $queueNumber = $index + 1;
                    break;
                }
            }

            $sell->update(['q_number' => $queueNumber]);

            $invoiceDetails = "🧾 *Invoice Details*\n";
            $invoiceDetails .= "Date: " . $sell->created_at->format('d-m-Y h:i A') . "\n";
            $invoiceDetails .= "Queue No: $queueNumber\n";
            $invoiceDetails .= "Invoice №: " . $sell->invoice_no . "\n";
            $invoiceDetails .= "Customer: " . ($sell->customer ? $sell->customer->first_name . ' ' . $sell->customer->last_name : 'Guest') . "\n\n";


            $invoiceDetails .= "Item\tQty\tPrice\tTotal\n";
            $invoiceDetails .= "--------------------------------\n";

            // 👉 Calculate subtotal
            $subtotal = 0;

            foreach ($sell->sellDetail as $detail) {
                $itemName = $detail->product ? $detail->product->names : 'Unknown';
                if ($detail->productVariant) {
                    $itemName .= ' ' . $detail->productVariant->variant_name;
                }

                $itemTotal = ($detail->qty ?? 1) * ($detail->price ?? 0);
                $subtotal += $itemTotal;

                $invoiceDetails .= $itemName . "\t" . $detail->qty . "\t$" . number_format($detail->price, 2) . "\t$" . number_format($itemTotal, 2) . "\n";
            }

            // 👉 Get discount from session
            $priceSession = session('price_cart');
            $discount = isset($priceSession['discount_price']) ? $priceSession['discount_price'] : 0;
            $grandTotal = $subtotal - $discount;

            $invoiceDetails .= "\nSubtotal: $" . number_format($subtotal, 2) . "\n";
            $invoiceDetails .= "Discount: $" . number_format($discount, 2) . "\n";
            $invoiceDetails .= "Grand Total: $" . number_format($grandTotal, 2) . "\n";
            $invoiceDetails .= "Paid by: " . ($sell->paymentMethod ? $sell->paymentMethod->names : 'N/A') . "\n";

            $text = urlencode($invoiceDetails);
            $apiToken = env('TELEGRAM_BOT_TOKEN');
            $chatId = env('TELEGRAM_CHAT_CHANEL');

            \Http::get("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&text=$text&parse_mode=Markdown");
        } catch (\Exception $exception) {
            \Log::error("Telegram Notification Error: " . $exception->getMessage());
        }
    }
}
