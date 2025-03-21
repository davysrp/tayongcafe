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

class AuthController extends Controller
{

    protected $username;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('username');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    //
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => ['required'],
            'password' => ['required']
        ]);
        $credentials = [$this->username => $request->username, 'password' => $request->password];
        // Authenticate an administrator
        if (auth()->guard('customer')->attempt($credentials)) {
            return redirect()->intended()->with('success', 'You logged in successfully');
        } else {
            return redirect()->back()->with('error', 'You have entered an invalid username or password');
        }
        return false;
    }

    public function logout(Request $request)
    {
        if (!\Auth::guard('customer')) return redirect()->back();
        auth()->guard('customer')->logout();  // Log out an administrator
        return redirect()->route('memberLogin')->with(['success' => 'Your account have been logged Out']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:sellers',
            'email' => 'required|string|lowercase|max:255|unique:sellers',
            'password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required|min:8',
        ]);

        $user = Customer::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);


        $data = [
            'email' => $request->email,
            'full_name' => $request->full_name
        ];

        $mail = Mail::send('frontend.auth.mail.welcome', $data, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('សូមស្វាគមន៍មកកាន់ KHMMO.COM – ចាប់ផ្តើមការទិញលក់ដោយទំនុកចិត្ត ជាមួយគ្នានៅទីនេះ!');
        });


        return redirect()->route('memberFormLogin');
    }

    public function registerForm()
    {
        return view('frontend.auth.register');
    }

    public function loginForm()
    {
        return view('frontend.auth.login');
    }

    public function forgotPasswordForm()
    {
        return view('frontend.auth.forgotpassword');
    }

    public function forgotPasswordSendLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $checkAccount = Customer::whereEmail($request->email)->first();
        if (!$checkAccount) return redirect()->back()->withInput()->with('error', 'Email Account dose not exist!');
        $token = csrf_token();
        $resetPassword = \DB::table('password_reset_tokens')->insert([
            'token' => $token,
            'email' => $request->email,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $data = [
            'token' => $token,
            'email' => $request->email
        ];
        $mail = Mail::send('frontend.auth.mail.resetpassword', $data, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Reset Password Notification');
        });
        return redirect()->back()->with('success', 'Please check you mailbox, Reset password have been sent.');

    }

    public function resetPasswordSendLink($token,Request $request)
    {
        $password = \DB::table('password_reset_tokens')->where('token', $token)->orderByDesc('id')->first();
        if ($password) return view('frontend.auth.setpassword', compact('password'));
        return redirect()->route('memberLogin')->with('error', 'Reset Password link expired');

    }

    public function saveChangePassword(Request $request)
    {
        $data = $this->validate($request, [
            'email' => 'required',
            'password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required',
        ]);
        if ($request->password) $data['password'] = \Hash::make($request->password);

        $findSellerAccount = Customer::whereEmail($request->email)->first();
        $findToken = \DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if ($findSellerAccount && $findToken) {

            $findSellerAccount->update(['password' => \Hash::make($request->password)]);
            \DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return redirect()->route('memberLogin')->with('success', 'Reset Password successfully');
        } else {
            return redirect()->route('memberLogin')->with('error', 'Something Wrong!');
        }

    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
//        try {
        $user = Socialite::driver('google')->user();

        // Check if the user exists in your database
        $existingUser = Customer::where('google_id', $user->id)->orWhere('email', $user->email)->first();

        if ($existingUser) {
//                if (auth()->guard('seller')->attempt(['google_id'=>$existingUser->google_id,'password'=>$user->id])) {
            if (auth()->guard('seller')->loginUsingId($existingUser->id)) {
                $existingUser->update(['google_id' => $user->id]);
                return redirect()->to(route('sellerprofile'))->with('success', 'You logged in successfully');

//                return redirect()->intended()->with('success', 'You logged in successfully');
            } else {
                return redirect()->back()->with('error', 'Something Wrong');
            }
        } else {
            // Create a new user
            $newUser = Customer::create([
                'full_name' => $user->name,
                'username' => $user->email,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => \Hash::make($user->id),
            ]);

            if (auth()->guard('seller')->loginUsingId($newUser->id)) {
                $data = [
                    'full_name' => $user->name,
                    'email' => $user->email
                ];
                /*$mail = Mail::send('frontend.auth.mail.resetpassword', $data, function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Reset Password Notification');
                });*/
//                return redirect()->intended()->with('success', 'You logged in successfully');
                return redirect()->to(route('sellerprofile'))->with('success', 'You logged in successfully');
            } else {
                return redirect()->back()->with('error', 'Something Wrong');
            }
        }
        /* } catch (\Exception $e) {
             // Handle errors
             \Log::info($e->getMessage());
             return redirect('home')->withError($e->getMessage());
         }*/
    }

}
