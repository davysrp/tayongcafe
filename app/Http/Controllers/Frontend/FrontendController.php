<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountRequest;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Sell;
use App\Models\Seller;
use App\Models\Webpage;
use Carbon\Carbon;
use Faker\Extension\Helper;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class FrontendController extends Controller
{

    //
    public function index(Request $request,$category=null)
    {
        $categories = Category::whereStatus(1)->get();

        $products = Product::whereStatus(1)
            ->where(function ($q) use($category){
                if ($category) $q->where('category_id', $category);
            })
            ->get();
        return view('frontend.index',compact('categories','products'));
    }

    
    //
    public function productList(Request $request)
    {

        $products = Product::where('status', 1)->where(function ($query) use ($request) {
            if ($request->category) $query->whereCategoryId($request->category);
            if ($request->search) $query->where('names', '%' . $request->search . '%');
        })->paginate(20);

        return view('frontend__.products', compact('products'));
    }

    public function productDetail($id)
    {
        $product = Product::whereSku($id)->first();
        return view('frontend__.productDetail', compact('product'));
    }

    public function page($id)
    {
        $page = Webpage::where('id', $id)->first();
        return view('frontend__.page', ['page' => $page]);
    }

    public function topUpBalance()
    {
        return view('frontend__.topup');
    }

    public function submitTopUpBalance(Request $request)
    {

        $auth = \Auth::guard('seller')->user()->id;
//        $destinationPath = public_path('uploads');
//        $bank_transaction = null;
//        if ($request->bank_transcript){
//            $photo = $request->file('bank_transcript');
//            $bank_transaction= \App\Models\Helper::imageOpt($photo, $destinationPath);
//        }
//
//        AccountRequest::create([
//            'amount' =>(float) $request->amount,
//            'bank_name' => $request->bank_name,
//            'bank_transcript' => $bank_transaction,
//            'transaction_type' => 2,
//            'status' => 0,
//            'seller_id' => $auth,
//            'dates' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-d-m'),
//            'times' => Carbon::now()->timezone('Asia/Bangkok')->format('H:i:s')
//        ]);
//        return redirect()->back()->with(['success'=>'ដាក់ស្នើរបានជោគជ័យ']);

        $model = PaymentMethod::find($request->payment_method_id);
        $reqs = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $model->token
        ])->post('https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5', [
            'md5' => $request->md5
        ]);
        $data = json_decode($reqs->body());

        if ($data->responseCode === 0) {
            $accountRequest=AccountRequest::create([
                'amount' => (float)$request->orderData['amount'],
                'bank_name' => 'KHQR',
                'bank_transcript' =>$request->orderData['invoice_no'] ,
                'transaction_type' => 2,
                'status' => 2,
                'seller_id' => $auth,
                'dates' => Carbon::now(),
                'times' => Carbon::now()->timezone('Asia/Bangkok')->format('H:i:s')
            ]);

            if ($accountRequest) {
                $accountRequest->update(['status' => 2]);
                $balance = Account::whereSellerId($accountRequest->seller_id)->first();
                if ($balance) {
                    $balance->update(['balance' => $balance->balance + $accountRequest->amount]);
                }else{
                    Account::create([
                        'seller_id' => $accountRequest->seller_id,
                        'balance' => $accountRequest->amount
                    ]);
                }
            }
            return response()->json(
                [
                    'success' => true,
                    'status' => 200,
                    'message' => 'Topup Success',
                ]
            );
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

    public function sellerProfile($username, Request $request)
    {

        $seller = Seller::where('full_name', str_replace('_', ' ', $username))->first();

        $products = Product::where('status', 1)->whereSellerId($seller->id)->where(function ($query) use ($request) {
            if ($request->category) $query->whereCategoryId($request->category);
            if ($request->search) $query->where('names', '%' . $request->search . '%');
        })->paginate(20);

        $category = Category::whereStatus(1)->pluck('names', 'id')->toArray();

        return view('frontend__.sellerProduct', compact('products', 'seller', 'category'));
    }

    public function requestKhqrPay()
    {
        return view('frontend__.cart.request-khqr');
    }

    public function khqrPay(Request $request)
    {
        $paymentMethod = PaymentMethod::find(1);
        $invoice = $request->invoice;
        return view('frontend__.cart.khqr', compact('paymentMethod', 'invoice'));
    }

    public function khqrPaymentSuccess()
    {
        return redirect()->route('orderDetail');
    }


}
