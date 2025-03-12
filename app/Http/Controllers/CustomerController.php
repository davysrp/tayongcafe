<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    

    /**
     * Display a listing of the resource.
     */

     

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Customer::select('customers.*');
            return DataTables::of($model)
                ->setRowAttr(['data-id' => function ($model) {
                    return $model->id;
                }])
                ->addColumn('action', function ($model) {
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-danger" data-id="'.$model->id.'" data-link="'.route('customers.destroy',$model->id).'" id="delete"><i class="fas fa-trash-alt"></i></button>
                              <a href="'.route('customers.edit',$model->id).'" type="button" class="btn btn-secondary" data-id="'.$model->id.'" id="edit" data-link="'.route('customers.edit',$model->id).'"><i class="fas fa-edit"></i></a>
                            </div>';
                    return $html;
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.customer.index');
    }

    public function create()
    {
        return view('backend.customer.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            #'email' => 'required|email|unique:customers,email',
            'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/'],

            #'phone_number' => 'nullable'
            'phone_number' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],


        ]);

        Customer::create($data);

        return redirect()->back()->with('success', 'Customer created successfully');
    }

    public function edit($id)
    {
        $model = Customer::findOrFail($id);
        return view('backend.customer.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            #'email' => 'required|email|unique:customers,email,'.$id,
            'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/' .$id],

            #'phone_number' => 'nullable'
            'phone_number' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],


        ]);

        $model = Customer::findOrFail($id);
        $model->update($data);

        return redirect()->back()->with('success', 'Customer updated successfully');
    }



    public function destroy($id)
    {
        $model = Customer::destroy($id);
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Customer deleted successfully'
        ]);
    }

    /**
     * Validate the request data.
     */
    public function data(Request $request)
    {

        $data = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'nullable|string|max:15',
        ]);
        
        return $data;
    }
}