<?php

namespace App\Http\Controllers;
use App\Models\Sell;

use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Webpage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentMethodController extends Controller
{     
    
    public function confirmPayment(Request $request)
    {
        $orderId = $request->input('order_id'); // Get order_id from form
    
        if (!$orderId) {
            return redirect()->back()->with('error', 'Invalid order ID');
        }
    
        // Find the order
        $sell = Sell::find($orderId);
        if (!$sell) {
            return redirect()->back()->with('error', 'Order not found!');
        }
    
        // Simulate Payment Success
        $sell->status = 'paid';
        $sell->save();
    
        return redirect()->back()->with([
            'payment_success' => true,
            'order_id' => $orderId
        ]);
    }
        

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = PaymentMethod::select('payment_methods.*');
            return DataTables::of($model)
                ->setRowAttr(['data-id' => function ($model) {
                    return $model->id;
                }])
                ->addColumn('action', function ($model) {
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-danger" data-id="'.$model->id.'" data-link="'.route('payment-method.destroy',$model->id).'" id="delete"><i class="fas fa-trash-alt"></i></button>
                              <a href="'.route('payment-method.edit',$model->id).'" class="btn btn-secondary" data-id="'.$model->id.'" id="edit" data-link="'.route('payment-method.edit',$model->id).'"><i class="fas fa-edit"></i></a>
                              <button type="button" class="btn btn-info" data-id="'.$model->id.'" id="renewToken" data-link="'.route('renewToken',$model->id).'"><i class="fas fa-edit"></i>Renew Token</button>
                            </div>';
                    return $html;
                })

                ->editColumn('status',function ($model){
                    return $model->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })

                // ->editColumn('status', function ($model) {
                //     return $model->status
                //         ? '<span class="badge badge-success">Active</span>'
                //         : '<span class="badge badge-danger">Inactive</span>';
                // })
                

                ->escapeColumns([])
                ->make(true);



        }
        return view('backend.payment_method.index');
    }

    public function renewToken($id)
    {

        $model = PaymentMethod::find($id);
        if ($model && $model->token) {
            $req = \Http::post('https://api-bakong.nbc.gov.kh/v1/renew_token',[
                'email'=>'phansophat2020@gmail.com'
            ]);
            return response()->json([
                'success'=>true,
                'status'=>200,
                'message'=>'Token renew successful'
            ]);
        }
    }

    public function create()
    {
        return view('backend.payment_method.create');
    }
    public function store(Request $request)
    {
        $data = $this->data($request);
        $model = PaymentMethod::create($data);
        return redirect()->back()-> with('success', 'Category Save successfully');
    }

    public function edit($id)
    {
        $model = PaymentMethod::find($id);
        return view('backend.payment_method.edit',compact('model'));

    }
    public function update(Request $request, $id)
    {
        $data = $this->data($request);
        $model = PaymentMethod::find($id);
        $model->update($data);
        return redirect()->back()-> with('success', 'Category Save successfully');
    }
    public function destroy($id)
    {
        $model = PaymentMethod::destroy($id);
        return response()->json([
            'success'=>true,
            'status'=>200,
            'message'=>'Category successful'
        ]);
    }
    public function data(Request $request)
    {
        $data = $this->validate($request, [
            'names' => 'required',
            'status' => 'required',
            // 'status' => 'required|in:0,1',
            'token' => 'nullable',
            'token_expired' => 'nullable',
            
        ]);
        return $data;

    }

}
