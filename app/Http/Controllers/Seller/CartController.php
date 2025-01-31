<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\CouponCode;
use App\Models\Helper;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductKey;
use App\Models\Sell;
use App\Models\SellDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    //
    public function index()
    {

        $auth = \Auth::guard('seller')->user()->id;
        $balance = Account::where('seller_id', $auth)->first();

        $cart = session()->get('cart');

        $subTotal = 0;
        if ($cart) {
            foreach ($cart as $id => $item) {
                $total = $item['quantity'] * $item['price'];
                $subTotal = $subTotal + $total;
            }
        }
        $paymentMethod = PaymentMethod::whereStatus(1)
            ->where(function ($query) use ($balance, $subTotal) {
                if (!$balance) $query->where('id', '!=', 4);
                if ($balance && $balance->balance < $subTotal) $query->where('id', '!=', 4);
            })
            ->get();
        return view('frontend__.cart.cartList', compact('paymentMethod', 'balance'));

    }

    public function addCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->productKey->count()) {
            if ($product->productKey()->whereStatus(1)->count() <= 0) {
                return redirect()->back()->with('error', 'ផលិតផលអស់ពីស្តុក');
            }
        }


        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->names,
                "quantity" => $request->qty ?? 1,
                "price" => $product->price,
                "photo" => $product->photo,
                "product_stock" => $product->productKey()->whereStatus(1)->count(),
                "is_product_stock" => $product->productKey->count() > 0 ? true : false
            ];
        }
        session()->put('cart', $cart);
        if ($request->buy_now) {
            return redirect()->route('cartList')->with('success', 'Product added to cart successfully!');
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function updateCart(Request $request)
    {

        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            if ($request->is_product_stock) {
                if ($request->quantity <= $request->product_stock) {
                    $cart[$request->id]["quantity"] = $request->quantity[$request->id];
                }else{
                    return redirect()->back()->with('error', 'ផលិតផលអស់ពីស្តុក');
                }
            }else{
                $cart[$request->id]["quantity"] =$request->quantity[$request->id];
            }

            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
            return redirect()->back()->with('success', 'Cart  update successfully!');
        }
        return $request->all();
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
        return redirect()->back();
    }

    public function placeOrder(Request $request)
    {
        $balance = Account::where('seller_id', $request->customer)->first();
        $data = [
            'dates' => Carbon::now(),
            'times' => Carbon::now()->format('H:i:s'),
            'seller_id_buyer' => $request->customer,
            'promo_code' => null,
            'total' => $request->total,
            'discount' => $request->discount,
            'grand_total' => $request->grand_total,
            'payment_method_id' => $request->payment_method_id,
            'status' => 1,
            'coupon_code_id' => $request->coupon_code_id,
            'invoice_no' => $request->invoice_no,
        ];
        if ($balance && $balance->balance >= $request->total) {
            $balance->update([
                'balance' => $balance->balance - $request->grand_total
            ]);
        }

        $cart = session()->get('cart');
        if ($cart) {
            $sell = Sell::create($data);
            foreach ($cart as $id => $item) {
                $getProductKey = ProductKey::whereProductId($id)->whereStatus(1)->take($item['quantity']);
                $keys = null;
                if ($getProductKey->get()) {
                    $keys = $getProductKey->pluck('product_key');
                    $getProductKey->update(['status' => 0]);
                }
                SellDetail::create(
                    [
                        'product_id' => $id,
                        'sell_id' => $sell->id,
                        'qty' => $item['quantity'],
                        'price' => $item['price'],
                        'discount' => 0,
                        'amount' => $item['quantity'] * $item['price'],
                        'product_key' => json_encode($keys),
                    ]
                );
            }
            $getSell = Sell::with(['sellDetail' => function ($q) {
                $q->with(['product']);
            }])->find($sell->id);

            $sums = [];
            $sell_detail = $getSell->sellDetail;

            foreach ($sell_detail as $detail) {
                $seller_id = $detail->product->seller_id;
                $amount = $detail['amount'];

                if (!isset($sums[$seller_id])) {
                    $sums[$seller_id] = 0;
                }

                $sums[$seller_id] += $amount;
            }
            if ($sums) {
                $sellerCommission = Setting::find(1);
                foreach ($sums as $key => $seller) {
                    $findSellerBalance = Account::where('seller_id', $key)->first();
                    $sellerAmount = $seller - (($sellerCommission->commission / 100) * $seller);

                    if ($findSellerBalance) {
                        $findSellerBalance->update([
                            'balance' => $findSellerBalance->balance + $sellerAmount
                        ]);
                    } else {
                        Account::create([
                            'seller_id' => $key,
                            'balance' => $sellerAmount
                        ]);
                    }
                }
            }
            session()->forget('cart');
            session()->forget('price_cart');
            return response()->json(
                [
                    'success' => true,
                    'status' => 200,
                    'message' => 'Order Success',
                ]
            );
        }

        return redirect()->back()->with('error', 'ជ្រើសរើសទំនិញដើម្បីទិញ!');
    }

    public function orderDetail($id)
    {
        $sell = Sell::with(['sellDetail' => function ($query) {
            $query->with('product');
        }])->findOrFail($id);

        return view('frontend__.cart.orderSuccess', compact('sell'))->with('success', 'ការកម្ម៉ង់ជោគជ័យ!');
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

    public function khqrPaymentSuccess(Request $request)
    {
        $sell = Sell::whereInvoiceNo($request->invoice)->first();

        if ($sell) {
            $sell->update(['status' => 1]);
            return redirect()->route('orderDetail', $sell->id);
        }
    }

    public function getPaymentMethod(Request $request)
    {
        $model = PaymentMethod::find($request->id);
        if ($model) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Payment list successful',
                'data' => [
                    'method' => $model,
                    'merchantInfoData' => Helper::merchantInfo(),
                    'optionalData_' => Helper::merchantOptionalInfo()
                ]
            ]);
        }
    }

    public function checkTransactionOrder(Request $request)
    {
        $model = PaymentMethod::find($request->payment_method_id);
        $reqs = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $model->token
        ])->post('https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5', [
            'md5' => $request->md5
        ]);

        if ($reqs->failed()) {

        }
        $data = json_decode($reqs->body());
        if ($data->responseCode === 0) {

            $data = [
                'dates' => Carbon::now(),
                'times' => Carbon::now()->format('H:i:s'),
                'seller_id_buyer' => $request->orderData['customer'],
                'promo_code' => null,
                'total' => $request->orderData['total'],
                'discount' => $request->orderData['discount'],
                'grand_total' => $request->orderData['grand_total'],
                'payment_method_id' => $request->orderData['payment_method_id'],
                'status' => 1,
                'coupon_code_id' => $request->orderData['coupon_code_id'],
                'invoice_no' => $request->orderData['invoice_no'],
            ];
            $cart = session()->get('cart');
            if ($cart) {
                $sell = Sell::create($data);
                foreach ($cart as $id => $item) {
                    $getProductKey = ProductKey::whereProductId($id)->whereStatus(1)->take($item['quantity']);
                    $keys = null;
                    if ($getProductKey->get()) {

                        $keys = $getProductKey->pluck('product_key');
                        $getProductKey->update(['status' => 0]);
                    }

                    SellDetail::create(
                        [
                            'product_id' => $id,
                            'sell_id' => $sell->id,
                            'qty' => $item['quantity'],
                            'price' => $item['price'],
                            'discount' => 0,
                            'amount' => $item['quantity'] * $item['price'],
                            'product_key' => json_encode($keys),
                        ]
                    );
                }


                $getSell = Sell::with(['sellDetail' => function ($q) {
                    $q->with(['product']);
                }])->find($sell->id);

                $sums = [];
                $sell_detail = $getSell->sellDetail;

                foreach ($sell_detail as $detail) {
                    $seller_id = $detail->product->seller_id;
                    $amount = $detail['amount'];

                    if (!isset($sums[$seller_id])) {
                        $sums[$seller_id] = 0;
                    }

                    $sums[$seller_id] += $amount;
                }
                if ($sums) {
                    $sellerCommission = Setting::find(1);
                    foreach ($sums as $key => $seller) {
                        $findSellerBalance = Account::where('seller_id', $key)->first();
                        $sellerAmount = $seller - (($sellerCommission->commission / 100) * $seller);

                        if ($findSellerBalance) {
                            $findSellerBalance->update([
                                'balance' => $findSellerBalance->balance + $sellerAmount
                            ]);
                        } else {
                            Account::create([
                                'seller_id' => $key,
                                'balance' => $sellerAmount
                            ]);
                        }
                    }
                }

                session()->forget('cart');
                session()->forget('price_cart');
                return response()->json(
                    [
                        'success' => true,
                        'status' => 200,
                        'message' => 'Order Success',
                    ]
                );
            }
        }elseif($data->responseCode == 1 && $data->errorCode==6){
            $req = \Http::post('https://api-bakong.nbc.gov.kh/v1/renew_token',[
                'email'=>'phansophat2020@gmail.com'
            ]);

            $tokenData = json_decode($req->body());
            $model->update(['token' => $tokenData->data->token]);
            dd([
                $req->body(),
                $model->token
                ,
                $data->responseCode,
                $data
            ]);

        }

        return response()->json($data);

    }
}
