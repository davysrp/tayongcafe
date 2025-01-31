<?php

namespace App\Http\Controllers;
use App\Models\CouponCode;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class CouponCodeController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = CouponCode::select('coupon_codes.*');
            return DataTables::of($model)
                ->setRowAttr(['data-id' => function ($model) {
                    return $model->id;
                }])
                ->addColumn('action', function ($model) {
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-danger delete-btn" data-id="'.$model->id.'" data-link="'.route('coupon-code.destroy',$model->id).'" id="delete"><i class="fas fa-trash-alt"></i></button>
                              <a href="'.route('coupon-code.edit',$model->id).'" type="button" class="btn btn-secondary" data-id="'.$model->id.'"><i class="fas fa-edit"></i></a>
                            </div>';
                    return $html;
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.coupon.index');
    }

    public function create()
    {
        return view('backend.coupon.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'coupon_name' => 'required|string|max:191',
            'coupon_code' => 'required|string|max:191|unique:coupon_codes',
            'percentage' => 'required|numeric|min:0|max:100',
            'discount_cap' => 'nullable|numeric|min:0',
            'max_use' => 'nullable|integer|min:0',
            'use_per_customer' => 'nullable|integer|min:0',
            'start_date' => 'required|date',
            'expired_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        CouponCode::create($data);
        return redirect()->route('coupon-code.index')->with('success', 'Coupon created successfully.');
    }

    public function edit($id)
    {
        $coupon = CouponCode::findOrFail($id);
        return view('backend.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'coupon_name' => 'required|string|max:191',
            'coupon_code' => 'required|string|max:191|unique:coupon_codes,coupon_code,' . $id,
            'percentage' => 'required|numeric|min:0|max:100',
            'discount_cap' => 'nullable|numeric|min:0',
            'max_use' => 'nullable|integer|min:0',
            'use_per_customer' => 'nullable|integer|min:0',
            'start_date' => 'required|date',
            'expired_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        $coupon = CouponCode::findOrFail($id);
        $coupon->update($request->all());

        return redirect()->route('coupon-code.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy($id)
    {
        $coupon = CouponCode::find($id);
    
        if (!$coupon) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Coupon not found'
            ]);
        }
    
        $coupon->forceDelete(); // Permanently delete the record
    
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Coupon permanently deleted successfully'
        ]);
    }



    // // public function index()
    // // {
    // //     $coupons = CouponCode::all();
    // //     return view('backend.coupon.index', compact('coupons'));
    // // }

    // public function index()
    // {
    //     $coupons = CouponCode::whereNull('deleted_at')->get(); // Exclude soft-deleted records
    //     return view('backend.coupon.index', compact('coupons'));
    // }
    

    // public function create()
    // {
    //     return view('backend.coupon.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'coupon_name' => 'required|string|max:191',
    //         'coupon_code' => 'required|string|max:191|unique:coupon_codes',
    //         'percentage' => 'required|numeric|min:0|max:100',
    //         'discount_cap' => 'nullable|numeric|min:0',
    //         'max_use' => 'nullable|integer|min:0',
    //         'use_per_customer' => 'nullable|integer|min:0',
    //         'start_date' => 'required|date',
    //         'expired_date' => 'required|date|after_or_equal:start_date',
    //         'status' => 'required|in:active,inactive',
    //     ]);

    //     CouponCode::create($request->all());
    //     return redirect()->route('coupon-code.index')->with('success', 'Coupon created successfully.');
    // }

    // public function edit($id)
    // {
    //     $coupon = CouponCode::findOrFail($id);
    //     return view('backend.coupon.edit', compact('coupon'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'coupon_name' => 'required|string|max:191',
    //         'coupon_code' => 'required|string|max:191|unique:coupon_codes,coupon_code,' . $id,
    //         'percentage' => 'required|numeric|min:0|max:100',
    //         'discount_cap' => 'nullable|numeric|min:0',
    //         'max_use' => 'nullable|integer|min:0',
    //         'use_per_customer' => 'nullable|integer|min:0',
    //         'start_date' => 'required|date',
    //         'expired_date' => 'required|date|after_or_equal:start_date',
    //         'status' => 'required|in:active,inactive',
    //     ]);

    //     $coupon = CouponCode::findOrFail($id);
    //     $coupon->update($request->all());

    //     return redirect()->route('coupon-code.index')->with('success', 'Coupon updated successfully.');
    // }

    // // public function destroy(CouponCode $coupon)
    // // {
    // //     $coupon->delete();
    // //     return response()->json([
    // //         'success' => true,
    // //         'message' => 'Coupon deleted successfully.',
    // //     ]);
    // // }


    // public function destroy(CouponCode $coupon)
    // {
    //     $coupon->forceDelete(); // Permanently deletes the record
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Coupon permanently deleted successfully.',
    //     ]);
    // }
 
    
    
}
