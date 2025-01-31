<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = ShippingMethod::select('shipping_methods.*');
            return DataTables::of($model)
                ->setRowAttr(['data-id' => function ($model) {
                    return $model->id;
                }])
                ->addColumn('action', function ($model) {
                    return '<div class="btn-group btn-group-sm" role="group">
                              <button type="button" class="btn btn-danger" data-id="'.$model->id.'" data-link="'.route('shipping-methods.destroy',$model->id).'" id="delete"><i class="fas fa-trash-alt"></i></button>
                              <a href="'.route('shipping-methods.edit',$model->id).'" class="btn btn-secondary"><i class="fas fa-edit"></i></a>
                            </div>';
                })
                ->editColumn('status', function ($model) {
                    return $model->status === 'active' 
                        ? '<span class="badge badge-success">Active</span>' 
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('backend.shipping_method.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.shipping_method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:191',
            'status' => 'required|in:active,inactive',
        ]);

        ShippingMethod::create($data);
        return redirect()->back()->with('success', 'Shipping method created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = ShippingMethod::findOrFail($id);
        return view('backend.shipping_method.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:191',
            'status' => 'required|in:active,inactive',
        ]);

        $model = ShippingMethod::findOrFail($id);
        $model->update($data);
        return redirect()->back()->with('success', 'Shipping method updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ShippingMethod::destroy($id);
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Shipping method deleted successfully.'
        ]);
    }
}
