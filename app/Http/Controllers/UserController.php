<?php

namespace App\Http\Controllers;

use App\Models\Helper;
use App\Models\Seller;
use App\Models\User;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-danger" data-id="' . $model->id . '" data-link="' . route('users.destroy', $model->id) . '" id="delete">
                                  <i class="fas fa-trash-alt"></i>
                              </button>
                              <a href="' . route('users.edit', $model->id) . '" class="btn btn-secondary">
                                  <i class="fas fa-edit"></i>
                              </a>
                            </div>';
                })
                ->addColumn('status', function ($model) {
                    return Helper::statusLabel($model->status);
                })
                ->addColumn('created_at', function ($model) {
                    return Helper::dateFormat($model->created_at);
                })
                ->addColumn('updated_at', function ($model) {
                    return Helper::dateFormat($model->updated_at);
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
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            #'email' => 'required|unique:users,email',
            'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/'],

            'password' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data['password'] = Hash::make($request->password);

        // Handle Profile Photo Upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'profile_pictures/' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $fileName); // Save to storage/app/public/profile_pictures
            $data['photo'] = $fileName;
        }

        User::create($data);

        return redirect()->back()->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing a user.
     */
    public function edit($id)
    {
        $model = User::findOrFail($id);
        return view('backend.users.edit', compact('model'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            #'email' => 'required|unique:users,email,' . $id,
            'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/' . $id],
            

            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user = User::findOrFail($id);

        // Handle Profile Photo Upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'profile_pictures/' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $fileName); // Save to storage/app/public/profile_pictures
            $data['photo'] = $fileName;

            // Delete old photo if it exists
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }
        }

        $user->update($data);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete the profile photo if it exists
        if ($user->photo && Storage::exists('public/' . $user->photo)) {
            Storage::delete('public/' . $user->photo);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'User deleted successfully'
        ]);
    }
}
