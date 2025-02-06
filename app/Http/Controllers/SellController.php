<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CouponCode;
use App\Models\Customer;
use App\Models\Khqr;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Sell;
use App\Models\SellDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
class SellController extends Controller
{

    public function monthlysell(Request $request, $seller)
    {
        $sell = Sell::with(['sellDetail' => function ($query) use ($seller) {
            $query->with([
                'product' => function ($query) use ($seller) {
                    $query->where('seller_id', $seller);
                }
            ]);
        }, 'paymentMethod', 'buyer'])->whereHas('sellDetail', function ($query) use ($seller) {
            $query->whereHas('product', function ($query) use ($seller) {
                $query->where('seller_id', $seller);
            });
        })
            ->where(function ($query) use ($request) {
                if ($request->order_date) {
                    $dates = explode('-', $request->order_date);
                    $startDate = trim($dates[0]);
                    $endDate = trim($dates[1]);
                    $query->whereBetween('sells.dates', [
                        Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d'),
                        Carbon::createFromFormat('d/m/Y', $endDate)->addDays(1)->format('Y-m-d'),
                    ]);
                }
                if ($request->status) {
                    $query->where('sells.status', $request->status);
                }
                if ($request->customer) {
                    $query->where('sellers.phone', 'LIKE', '%' . $request->customer . '%');
                    $query->orWhere('sellers.full_name', 'LIKE', '%' . $request->customer . '%');
                    $query->orWhere('sellers.facebook', 'LIKE', '%' . $request->customer . '%');
                }
            })
            ->get();

        return view('frontend__.monthlysell', compact('sell', 'seller'));
    }

    public function soldproduct(Request $request, $seller)
    {

        $model = DB::table('products')
            ->join('sell_details', 'products.id', '=', 'sell_details.product_id')
            ->join('sells', 'sells.id', '=', 'sell_details.sell_id')
            ->where('seller_id', $seller)->get();

        return view('frontend__.soldproduct', ['sell' => $model]);
    }

    public function boughtproduct(Request $request, $buyer)
    {

        $model = Product::join('sell_details', 'products.id', '=', 'sell_details.product_id')
            ->join('sells', 'sells.id', '=', 'sell_details.sell_id')
            ->where('seller_id_buyer', $buyer)
            ->orderBy('sells.id', 'DESC')
            ->get();


        return view('frontend__.boughtproduct', ['sell' => $model]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Sell::leftjoin('payment_methods', 'payment_methods.id', 'sells.payment_method_id')
                ->leftjoin('coupon_codes', 'coupon_codes.id', 'sells.coupon_code_id')
                ->leftjoin('sellers', 'sellers.id', 'sells.seller_id_buyer')
                ->where(function ($query) use ($request) {
                    if ($request->order_date) {
                        $dates = explode('-', $request->order_date);
                        $startDate = trim($dates[0]);
                        $endDate = trim($dates[1]);
                        $query->whereBetween('sells.dates', [
                            Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d'),
                            Carbon::createFromFormat('d/m/Y', $endDate)->addDays(1)->format('Y-m-d'),
                        ]);
                    }
                    if ($request->status) {
                        $query->where('sells.status', $request->status);
                    }
                    if ($request->customer) {
                        $query->where('sellers.phone', 'LIKE', '%' . $request->customer . '%');
                        $query->orWhere('sellers.full_name', 'LIKE', '%' . $request->customer . '%');
                        $query->orWhere('sellers.facebook', 'LIKE', '%' . $request->customer . '%');
                    }
                })
                ->select('sells.*', 'payment_methods.names as payment_method', 'coupon_codes.coupon_name', 'sellers.full_name as customer');
            return DataTables::of($model)
                ->addColumn('action', function ($model) {
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-danger" data-id="' . $model->id . '" data-link="' . route('sells.destroy', $model->id) . '" id="delete"><i class="fas fa-trash-alt"></i></button>
                            <button type="button" class="btn btn-secondary" data-id="' . $model->id . '" id="edit" data-link="' . route('sells.edit', $model->id) . '"><i class="fas fa-edit"></i></button>
                            </div>';
                    return $html;
                })
                ->editColumn('status', function ($model) {
                    return $model->status ? '<span class="badge badge-success">Paid</span>' : '<span class="badge badge-danger">Unpaid</span>';
                })
                ->editColumn('total', function ($model) {
                    return number_format($model->total, 2);
                })
                ->editColumn('grand_total', function ($model) {
                    return number_format($model->grand_total, 2);
                })
                ->editColumn('discount', function ($model) {
                    return number_format($model->discount, 2);
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.sells.index');
    }

    public function sellreport($seller, Request $reg)
    {
        $model = DB::table('products')
            ->join('sell_details', 'products.id', '=', 'sell_details.product_id')
            ->join('sells', 'sells.id', '=', 'sell_details.sell_id')
            ->where('seller_id', $seller)->get();
        return view('backend.sells.sellreport', ['sell' => $model]);
    }

    public function buylist($buyer, Request $reg)
    {
        $model = DB::table('products')
            ->join('sell_details', 'products.id', '=', 'sell_details.product_id')
            ->join('sells', 'sells.id', '=', 'sell_details.sell_id')
            ->where('seller_id_buyer', $buyer)->get();
        return view('backend.sells.buylist', ['sell' => $model]);
    }

    public function create()
    {

        $invoiceNumber = 'INV-' . strtoupper(uniqid()); // Generate invoice number
        $currentDate = Carbon::now()->toDateString(); // Current date
        $currentTime = Carbon::now()->toTimeString(); // Current time
        $buyers = User::where('role', 'buyer')->get(); // Fetch buyers
        $sellers = User::where('role', 'seller')->get(); // Fetch sellers
        $paymentMethods = PaymentMethod::all(); // Fetch payment methods
        $couponCodes = CouponCode::all(); // Fetch coupon codes
        // Auto-generate invoice number
        $invoiceNumber = 'INV-' . time() . '-' . strtoupper(uniqid());

        // Auto-set current date
        $currentDate = date('Y-m-d');

        // Fetch necessary data for dropdowns
        $buyers = User::where('role', 'buyer')->get(); // Fetch buyers
        $sellers = User::where('role', 'seller')->get(); // Fetch sellers
        // $paymentMethods = PaymentMethod::all(); // Fetch payment methods
        // return view('backend.sells.create', compact('invoiceNumber', 'currentDate', 'buyers', 'sellers'));

        return view('backend.sells.create', compact(
            'invoiceNumber',
            'currentDate',
            'currentTime',
            'buyers',
            'sellers',
            'paymentMethods',
            'couponCodes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'dates' => 'required|date',
            'times' => 'required',
            'user_id_buyer' => 'required|exists:users,id',
            'user_id_seller' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'promo_code' => 'nullable|string',
            'discount' => 'nullable|numeric',
            'pay_method' => 'required|string',
            'grand_total' => 'required|numeric',
            'status' => 'required|in:0,1',
        ]);

        // Create the sell record
        $sell = Sell::create([
            'dates' => $request->input('dates'),
            'times' => $request->input('times'),
            'user_id_buyer' => $request->input('user_id_buyer'),
            'user_id_seller' => $request->input('user_id_seller'),
            'total' => $request->input('total'),
            'promo_code' => $request->input('promo_code'),
            'discount' => $request->input('discount'),
            'pay_method' => $request->input('pay_method'),
            'grand_total' => $request->input('grand_total'),
            'status' => $request->input('status'),
        ]);

        // Return a JSON response
        if ($sell) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Sell created successfully',
                'data' => $sell
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Failed to create the sell record',
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Sell $sell)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sell $sell, $id)
    {
        $sell = Sell::findOrFail($id);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Sell data retrieved successfully',
            'data' => $sell
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sell $sell, $id)
    {
        $sell = Sell::findOrFail($id);
        $sell->update([
            'dates' => $request->input('dates'),
            'times' => $request->input('times'),
            'user_id_buyer' => $request->input('user_id_buyer'),
            'user_id_seller' => $request->input('user_id_seller'),
            'total' => $request->input('total'),
            'promo_code' => $request->input('promo_code'),
            'discount' => $request->input('discount'),
            'pay_method' => $request->input('pay_method'),
            'grand_total' => $request->input('grand_total'),
            'status' => $request->input('status'),
        ]);


        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Sell updated successfully',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sell $sell, $id)
    {
        $sell = Sell::find($id);


        if (!$sell) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Sell record not found',
            ]);
        }


        $deleted = $sell->delete();

        if ($deleted) {

            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Sell deleted successfully',
            ]);
        } else {

            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Failed to delete the sell record',
            ]);
        }

    }

    public function data(Request $request)
    {

        $validatedData = $request->validate([
            'dates' => 'required|date_format:Y-m-d',
            'times' => 'required|date_format:H:i:s',
            'user_id_buyer' => 'required|integer|exists:users,id',
            'user_id_seller' => 'required|integer|exists:users,id',
            'total' => 'required|numeric',
            'promo_code' => 'nullable|string',
            'grand_total' => 'required|numeric',
            'status' => 'required',
        ]);

        return $validatedData;


    }

    public function saleDashboard()
    {
        return view('backend.sells.saleDashboard');
    }

    public function saleForm($table)
    {
        $customers = Customer::all();
        $shippingMethods = ShippingMethod::where('status', 'active')->get();
        $category = Category::whereStatus(1)->get();

        // Get the latest "paid" order for this table
        $order = Sell::with(['sellDetail', 'customer'])
                    ->where('table_id', $table)
                    ->whereIn('status', ['pending', 'paid']) // Include pending or paid orders
                    ->latest()
                    ->first();

        $paymentMethods = PaymentMethod::where('status', 'active')->get();

        return view('backend.sells.saleForm', compact('category', 'order', 'table', 'paymentMethods', 'customers', 'shippingMethods'));
    }




    public function getProductByCategory(Request $request)
    {
        $product = Product::with(['productVariant'])->where('category_id', $request->category_id)->get();

        return [
            'success' => true,
            'data' => $product
        ];
    }

    public function addCardItem(Request $request)
    {
        $sell = Sell::where('table_id', $request->table_id)->where('status', 'pending')->first();
        if ($sell) {
            $findProduct = Product::find($request->product_id);
            $findItem = SellDetail::where('sell_id', $sell->id)->where('product_id', $findProduct->id)
                ->where(function ($q) use ($request) {
                    if ($request->product_variant_id) $q->where('product_variant_id', $request->product_variant_id);
                })
                ->first();

            $price = 0;
            if (!$request->product_variant_id) {
                $price = $findProduct->price;
            } else {
                $findVariant = ProductVariant::find($request->product_variant_id);
                $price = $findVariant->variant_price;
            }
            $total = $request->qty * $price;

            if (!$findItem) {
                SellDetail::create([
                    'sell_id' => $sell->id,
                    'product_id' => $findProduct->id,
                    'product_variant_id' => $request->product_variant_id,
                    'qty' => $request->qty,
                    'price' => $price,
                    'total' => $total,
                ]);
            } else {
                $totalQty = $findItem->qty + $request->qty;
                $total = $totalQty * $price;
                $findItem->update([
                    'qty' => $totalQty,
                    'price' => $price,
                    'total' => $total,
                ]);
            }


        } else {
            $findProduct = Product::find($request->product_id);

            $newSell = Sell::create([
                'table_id' => $request->table_id,
                'invoice_no' => Sell::invoiceNo(),
                'customer_id' => $request->customer_id ?? null,
                'status' => 'pending'
            ]);
            $price = 0;
            if (!$request->product_variant_id) {
                $price = $findProduct->price;
            } else {
                $findVariant = ProductVariant::find($request->product_variant_id);
                $price = $findVariant->variant_price;

            }
            $total = $request->qty * $price;
            SellDetail::create([
                'sell_id' => $newSell->id,
                'product_id' => $findProduct->id,
                'product_variant_id' => $request->product_variant_id ?? null,
                'qty' => $request->qty,
                'price' => $price,
                'total' => $total
            ]);
        }



        return [
            'success' => true,
        ];
    }


    public function orderItemList(Request $request)
    {
        $sell = Sell::with(['couponCode', 'sellDetail' => function ($query) {
            $query->with(['product', 'productVariant']);
        }])->where('table_id', $request->table_id)->where('status', 'pending')->first();

        if ($sell) {
            return [
                'success' => true,
                'data' => $sell
            ];
        } else {
            return [
                'success' => false,

            ];
        }

    }

    public function applyCouponCode(Request $request)
    {
        $sell = Sell::with(['sellDetail'])->where('table_id', $request->table_id)->first();

        if ($sell) {
            $couponCode = CouponCode::where('id', $request->coupon_code_id)->where('status', 'active')->first();
            if ($couponCode) {
                $currentDate = Carbon::now();
                $startDate = Carbon::parse($couponCode->start_date);
                $endDate = Carbon::parse($couponCode->expired_date);
                if ($currentDate->between($startDate, $endDate)) {

                    $countCouponUsed = Sell::where('coupon_code_id', $request->coupon_code_id)->count();
                    if ($countCouponUsed >= $couponCode->max_use) {
                        return [
                            'success' => false,
                            'message' => 'Coupon apply Max Used'
                        ];
                    } else {
                        $couponDiscount = 0;
                        $total = $sell->sellDetail()->sum('total');
                        $discount = $total * ($couponCode->percentage / 100);

                        if ($discount > $couponCode->discount_cap) {
                            $couponDiscount = $couponCode->discount_cap;
                        } else {
                            $couponDiscount = $discount;

                        }

                        $grandTotal = $total - $couponDiscount;

                        $sell->update([
                            'sub_total' => $total,
                            'discount' => $couponDiscount,
                            'grand_total' => $grandTotal,
                            'coupon_code_id' => $couponCode->id,

                        ]);
                        return [
                            'success' => true,
                            'message' => 'Coupon apply successfully'
                        ];
                    }

                } else {
                    return [
                        'success' => false,
                        'message' => 'Coupon Invalid'
                    ];
                }
            }
        }


    }


    public function getCouponCode(Request $request)
    {

        if ($request->q) {
            $coupon = CouponCode::where('coupon_code', 'LIKE', '%' . $request->q . '%')->get();
        } else {
            $coupon = CouponCode::where('coupon_code', 'LIKE', '%' . $request->q . '%')->take(20)->get();
        }
        $data = [];
        foreach ($coupon as $key => $item) {
            $data[] = ['id' => $item->id, 'text' => $item->coupon_code];
        }
        return response()->json($data);
    }

    public function getCustomer(Request $request)
    {

        if ($request->q) {
            $customer = Customer::where('name', 'LIKE', '%' . $request->q . '%')->get();
        } else {
            $customer = Customer::where('name', 'LIKE', '%' . $request->q . '%')->take(20)->get();
        }
        $data = [];
        foreach ($customer as $key => $item) {
            $data[] = ['id' => $item->id, 'text' => $item->name];
        }
        return response()->json($data);
    }

    public function getPaymentMethod(Request $request)
    {
        $paymentMethod = PaymentMethod::find($request->id);
        return [
            'success' => true,
            'data' => [
                'method' => $paymentMethod,
                'merchantInfoData' => Khqr::merchantInfo(),
                'optionalData_' => Khqr::merchantOptionalInfo(),

            ]
        ];
    }


    public function checkTransactionOrder(Request $request)
    {
        if ($request->payment_method_id==1) {
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
                $sell = Sell::with(['sellDetail'])->where('table_id', $request->orderData['table_id'])->where('status', 'pending')->first();
                $sell->update([
                    'invoice_no' => $request->orderData['invoice_no'],
                    'status' => 'paid',
                    'payment_method_id' => $request->payment_method_id
                ]);
                $this->telegramNotification($request);
                return [
                    'success' => true,
                    'message' => true,
                    'data' => $sell,
                ];

            } elseif ($data->responseCode == 1 && $data->errorCode == 6) {
                $req = \Http::post('https://api-bakong.nbc.gov.kh/v1/renew_token', [
                    'email' => 'phansophat2020@gmail.com'
                ]);
                $tokenData = json_decode($req->body());
                $model->update(['token' => $tokenData->data->token]);
            }
        } else {
            $sell = Sell::with(['sellDetail'])->where('table_id', $request->orderData['table_id'])->where('status', 'pending')->first();
            $subtotal = $sell->sellDetail()->sum('total');
            $sell->update([
                'status' => 'paid',
                'payment_method_id' => $request->payment_method_id,
                'total' => $sell->total?$sell->total:$subtotal,
                'grand_total' => $sell->grand_total?$sell->grand_total:$subtotal
            ]);

            $this->telegramNotification($request);
            return [
                'success' => true,
                'message' => 'Order successfully',
                'data' => $sell,
            ];
        }
    }

    public function updateRemoveQty(Request $request)
    {
        $findItem = SellDetail::find($request->id);
        if ($request->type == 'remove') {
            $findItem->delete();


        } else {
            if ($request->type == 'minus')  $qty = $findItem->qty - $request->qty;
            if ($request->type == 'plus')  $qty = $findItem->qty + $request->qty;

            if ($qty == 0) {
                $findItem->delete();
            } else {
                $findItem->update([
                    'price' => $findItem->price,
                    'qty' => $qty,
                    'total' => $findItem->price * $qty
                ]);
            }

        }
        return [
            'success' => true,
            'message' => 'Update successfully',
        ];


    }

    public function confirmSale(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'coupon_code_id' => 'nullable|exists:coupon_codes,id',
            'remark' => 'nullable|string|max:255',
        ]);

        $sell = Sell::create([
            'customer_id' => $request->customer_id,
            'shipping_method_id' => $request->shipping_method_id,
            'payment_method_id' => $request->payment_method_id,
            'coupon_code_id' => $request->coupon_code_id,
            'remark' => $request->remark,
            'sub_total' => 0,
            'discount' => 0,
            'grand_total' => 0,
        ]);

        return redirect()->route('saleDashboard')->with('success', 'Sale Confirmed Successfully!');
    }


    public function downloadInvoice($id)
    {
        $sell = Sell::with(['customer', 'sellDetail.product'])->findOrFail($id);

        // Generate the PDF
        $pdf = PDF::loadView('backend.sells.invoice', compact('sell'));

        // Return the PDF as a download
        return $pdf->download('invoice_'.$sell->invoice_no.'.pdf');
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


    // public function processPayment(Request $request)
    // {
    //     // Simulate payment success or failure
    //     $paymentStatus = rand(0, 1) ? 'success' : 'failed';

    //     // Set the message
    //     $message = $paymentStatus === 'success'
    //         ? "🚀 Payment Successful! Your order is confirmed."
    //         : "❌ Payment Failed! Please try again later.";

    //     // Get Telegram API Token & Chat ID from .env
    //     $apiToken = env('TELEGRAM_BOT_TOKEN');
    //     $chatId = env('TELEGRAM_CHAT_CHANEL');

    //     // Send Telegram Notification using Http::get()
    //     $response = Http::get("https://api.telegram.org/bot{$apiToken}/sendMessage", [
    //         'chat_id' => $chatId,
    //         'text' => $message
    //     ]);

    //     // Return response (including Telegram API response for debugging)
    //     return response()->json([
    //         'status' => $paymentStatus,
    //         'telegram_response' => $response->json()
    //     ]);
    // }



}
