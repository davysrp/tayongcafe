<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Yajra\DataTables\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

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
            'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/'],
            'phone_number' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
        ]);

        try {
            Customer::create($data);
            return redirect()->back()->with('success', 'Customer created successfully');
        } catch (QueryException $e) {
            // Log::error("Database error in store(): " . $e->getMessage());

            if ($e->getCode() == 23000) {
                return redirect()->back()->withInput()->with('error', 'This email is already registered. Please use a different email.');
            }
            return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function edit($id)
    {
        $model = Customer::findOrFail($id);
        return view('backend.customer.edit', compact('model'));
    }



    // public function update(Request $request, $id)
    // {
    //     $data = $this->validate($request, [
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/', "unique:customers,email,$id"],
    //         'phone_number' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
    //     ]);
    
    //     try {
    //         $model = Customer::findOrFail($id);
    //         $model->update($data);
    //         return redirect()->back()->with('success', 'Customer updated successfully');
    //     } catch (QueryException $e) {
    //         // Log::error("Database error in update(): " . $e->getMessage());
    
    //         if ($e->getCode() == 23000) { // Integrity constraint violation (Duplicate Entry)
    //             return redirect()->back()->withInput()->with('error', 'This email is already registered. Please use a different email.');
    //         }
    
    //         return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
    //     }
    // }
    

    // public function update(Request $request, $id)
    // {
    //     $data = $this->validate($request, [
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/', "unique:customers,email,$id"],
    //         'phone_number' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
    //     ]);
    
    //     try {
    //         $model = Customer::findOrFail($id);
    //         $model->update($data);
    //         return redirect()->back()->with('success', 'Customer updated successfully');
    //     } catch (QueryException $e) {
    //         if ($e->getCode() == 23000) { // Integrity constraint violation (Duplicate Entry)
    //             return redirect()->back()->withInput()->with('error', 'This email is already registered. Please use a different email.');
    //         }
    
    //         return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
    //     }
    // }
    

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/', "unique:customers,email,$id"],
            'phone_number' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
        ]);
    
        try {
            $model = Customer::findOrFail($id);
            $model->update($data);
    
            // If request is AJAX, return JSON success response
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Customer updated successfully']);
            }
    
            return redirect()->back()->with('success', 'Customer updated successfully');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) { // Duplicate email error
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'This email is already registered. Please use a different email.']);
                }
                return redirect()->back()->withInput()->with('error', 'This email is already registered. Please use a different email.');
            }
    
            return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }
    


    public function destroy($id)
    {
        $model = Customer::find($id);

        if (!$model) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Customer not found'
            ], 404);
        }

        $model->delete();
        
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Customer deleted successfully'
        ]);
    }

    public function data(Request $request, $id = null)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers,email' . ($id ? ',' . $id : ''),
            'phone_number' => 'nullable|string|max:15',
        ];

        return $this->validate($request, $rules);
    }
}
