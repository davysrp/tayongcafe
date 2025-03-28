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



// class UserController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index(Request $request)
//     {
//         if ($request->ajax()) {
//             $model = User::select('users.*');
//             return DataTables::of($model)
//                 ->setRowAttr(['data-id' => function ($model) {
//                     return $model->id;
//                 }])
//                 ->addColumn('action', function ($model) {
//                     return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
//                               <button type="button" class="btn btn-danger" data-id="' . $model->id . '" data-link="' . route('users.destroy', $model->id) . '" id="delete">
//                                   <i class="fas fa-trash-alt"></i>
//                               </button>
//                               <a href="' . route('users.edit', $model->id) . '" class="btn btn-secondary">
//                                   <i class="fas fa-edit"></i>
//                               </a>
//                             </div>';
//                 })
//                 ->addColumn('status', function ($model) {
//                     return Helper::statusLabel($model->status);
//                 })
//                 ->addColumn('created_at', function ($model) {
//                     return Helper::dateFormat($model->created_at);
//                 })
//                 ->addColumn('updated_at', function ($model) {
//                     return Helper::dateFormat($model->updated_at);
//                 })
//                 ->escapeColumns([])
//                 ->make(true);
//         }
//         return view('backend.users.index');
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         return view('backend.users.create');
//     }

//     public function store(Request $request)
//     {
//         $data = $request->validate([
//             'name' => 'required',
//             'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/'],
//             'password' => 'required',
//             'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
//         ]);
    
//         $data['password'] = Hash::make($request->password);
    
//         // Handle Profile Photo Upload
//         if ($request->hasFile('photo')) {
//             $photo = $request->file('photo');
//             $filename = 'profile_pictures/' . time() . '.' . $photo->getClientOriginalExtension();
//             $photo->storeAs('public', $filename); // Save in storage/app/public/profile_pictures
//             $data['photo'] = $filename;
//         } else {
//             $data['photo'] = 'profile_pictures/defaultprofile.png'; // Set default photo
//         }
    
//         User::create($data);
    
//         return redirect()->back()->with('success', 'User created successfully.');
//     }
    

//     /**
//      * Show the form for editing a user.
//      */
//     public function edit($id)
//     {
//         $model = User::findOrFail($id);
//         return view('backend.users.edit', compact('model'));
//     }

    

//     public function update(Request $request, $id)
//     {
//         $data = $request->validate([
//             'name' => 'required',
//             'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/'],
//             'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
//         ]);
    
//         if ($request->password) {
//             $data['password'] = Hash::make($request->password);
//         }
    
//         $user = User::findOrFail($id);
    
//         // Handle Profile Photo Upload
//         if ($request->hasFile('photo')) {
//             // Delete the old photo (if it's not the default photo)
//             // if ($user->photo && $user->photo !== 'profile_pictures/defaultprofile.png' && Storage::exists('public/' . $user->photo)) {
//             if ($user->photo && $user->photo !== 'defaultprofile.png' && Storage::exists('public/' . $user->photo)) {
//                 Storage::delete('public/' . $user->photo);
//             }
    
//             // Store new photo
//             $photo = $request->file('photo');
//             $filename = 'profile_pictures/' . time() . '.' . $photo->getClientOriginalExtension();
//             $photo->storeAs('public', $filename);
//             $data['photo'] = $filename;
//         }
    
//         $user->update($data);
    
//         return redirect()->back()->with('success', 'User updated successfully.');
//     }
    
//     public function destroy($id)
//     {
//         $user = User::findOrFail($id);

//         // Delete the profile photo if it exists
//         if ($user->photo && Storage::exists('public/' . $user->photo)) {
//             Storage::delete('public/' . $user->photo);
//         }

//         $user->delete();

//         return response()->json([
//             'success' => true,
//             'status' => 200,
//             'message' => 'User deleted successfully'
//         ]);
//     }
// }





class UserController extends Controller
{
    /**
     * Display a listing of users.
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
                    return '<div class="btn-group btn-group-sm" role="group">
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
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/', 'unique:users,email'],
            'password' => 'required|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data['password'] = Hash::make($request->password);

        // Handle profile photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = 'profile_pictures/' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public', $filename);
            $data['photo'] = $filename;
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
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'regex:/^[^@]+@gmail\.com$/', 'unique:users,email,' . $id],
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            
        ]);

        $user = User::findOrFail($id);

        // Update password only if provided
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']); // Keeps the existing password
        }

        // Handle profile photo update
        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }

            // Store new photo
            $photo = $request->file('photo');
            $filename = 'profile_pictures/' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public', $filename);
            $data['photo'] = $filename;
        } else {
            unset($data['photo']); // Keeps the existing photo if no new one is uploaded
        }

        // Update only the provided fields
        $user->update($data);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
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
