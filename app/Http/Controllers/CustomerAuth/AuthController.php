<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sell;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Socialite\Facades\Socialite;
use function Ramsey\Uuid\Generator\timestamp;
use const Symfony\Component\Routing\Requirement\UUID;


use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{


    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => ['required'],
            'password' => ['required'],
        ]);
    
        $customer = Customer::where('phone_number', $request->username)->first();
    
        if ($customer && Hash::check($request->password, $customer->password)) {
            Auth::guard('customer')->login($customer);
            return redirect()->intended()->with('success', 'You logged in successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid phone number or password');
        }
    }
    

    // Method to show login form
    public function loginForm()
    {
        return view('auth.member-login');
    }

    


    public function register(Request $request)
    {
        // Validate request
        $request->validate([
            'full_name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:15|unique:customers',
            'email' => 'nullable|email|max:100|unique:customers',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional photo validation
        ]);

        // Split full name
        $name_parts = explode(' ', $request->full_name);
        $first_name = $name_parts[0];
        $last_name = isset($name_parts[1]) ? $name_parts[1] : '';

        // Handle photo upload if present
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = 'customer_pictures/' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public', $filename);
            $photoPath = $filename;
        }

        // Create new customer
        $customer = Customer::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            // 'password' => null, // Optional password
            'password' => Hash::make($request->password),

            'userphoto' => $photoPath,
        ]);



        // Redirect to login page
        return redirect()->route('memberFormLogin')->with('success', 'Registration successful. Please login.');
    }



    // Show the registration form view
    public function registerForm()
    {
        return view('auth.member-register'); // View path for the registration form
    }



    public function logout(Request $request)
    {
        // Log the user out
        Auth::guard('customer')->logout();

        // Invalidate the session and clear session data
        $request->session()->invalidate();

        // Regenerate session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect to login page with a success message
        return redirect()->route('homePage')->with('success', 'You have been logged out');

        // return redirect()->route('/')->with('success', 'You have been logged out');
    }
    public function showpro()
    {
        $customer = Auth::guard('customer')->user();
        return view('auth.member.profile', compact('customer'));
    }



    public function update(Request $request)
    {
        $customer = \App\Models\Customer::find(Auth::guard('customer')->id());
    
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'phone_number' => 'nullable|string|regex:/^[0-9]{8,15}$/|unique:customers,phone_number,' . $customer->id,
            'password' => 'required|string|min:6|confirmed',

        ]);
    
        $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
        ]);
    
        return back()->with('success', 'Profile updated successfully!');
    }
    
    public function updatePhoto(Request $request)
    {
        $customer = \App\Models\Customer::find(Auth::guard('customer')->id());
    
        $request->validate([
            'photo' => 'required|image|max:2048', // Max 2MB
        ]);
    
        // Delete old photo if it exists and is not the default photo
        if ($customer->userphoto && $customer->userphoto !== 'customer_pictures/customerdefaultprofile.png') {
            $oldPhotoPath = storage_path('app/public/' . $customer->userphoto);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
    
        // Save new photo
        $photo = $request->file('photo');
        $path = 'customer_pictures/' . time() . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs('public', $path);
    
        $customer->update(['userphoto' => $path]);
    
        return back()->with('success', 'Profile photo updated successfully!');
    }


}
