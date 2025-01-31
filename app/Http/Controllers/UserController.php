<?php

namespace App\Http\Controllers;

use App\Models\Helper;
use App\Models\Seller;
use App\Models\User;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = User::select('users.*');
            return DataTables::of($model)
                ->setRowAttr(['data-id' => function ($model) {
                    return $model->id;
                }])
                ->addColumn('action', function ($model) {
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-danger" data-id="' . $model->id . '" data-link="' . route('users.destroy', $model->id) . '" id="delete"><i class="fas fa-trash-alt"></i></button>
                              <a href="'.route('users.edit', $model->id).'" class="btn btn-secondary" data-id="' . $model->id . '" id="edit" data-link="' . route('users.edit', $model->id) . '"><i class="fas fa-edit"></i></a>
                            </div>';
                    return $html;
                })
                ->addColumn('status', function ($model) {
                    return Helper::statusLabel($model->status);
                })
                ->addColumn('created_at', function ($model) {
                    return Helper::dateFormat($model->created_at);
                })
                ->addColumn('updated_at', function ($model) {
                    return Helper::dateFormat($model->created_at);
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'password' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email',
        ]);
        $data['password'] = \Hash::make($request->password);
        User::create($data);

        return redirect()->back()-> with('success', 'Category Save successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = User::find($id);
        return view('backend.users.edit',compact('model'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        $data = $this->validate($request, [

            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,

        ]);
        if ($request->password) $data['password'] = \Hash::make($request->password);
        $user = User::find($id);
        $user->update($data);
        return redirect()->back()-> with('success', 'Category Save successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = User::find($id);
        $model->delete();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'User Account delete successful'
        ]);
    }
    public function data(Request $request)
    {
        $data = $this->validate($request, [

            'name' => 'nullable',
            'email' => 'required',

        ]);
        return $data;

    }
}
