<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OtpController extends Controller
{
    //
    public function sendOtp(Request $request)
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $private_key = 'u7bGcvT23XFw_weHxOWOwVT5OpQDvv3MTEGNTuYsDU_q0xu9EUSVYXaS73CbUYC4ax4fCUSWPxrlE0l6S80q0A';
  // start send SMS

        $reps = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Secret' => '$5$rounds=535000$2yLi0cbXNbEB/3.s$qYTTC70xy/71CkEyvK1vtNqxcTf/OWtXlWl.dndKp2/',
        ])
            ->withOptions(['verify' => base_path() . '/public/plasgate-ca-bundle.crt'])
            ->post('https://cloudapi.plasgate.com/rest/send?private_key=' . $private_key,
                [
                   
                   
                    'sender' => 'PlasGateUAT',
                    'to' => $request->phone,
                    'content' => 'Your TANTONG OTP is ' . $otp . '.',
                ]
            );

            // End send SMS
        \Session::put('otp_sent', true);
        \Session::put('otp', $otp);
        \Session::put('otp_phone', $request->phone);
        \Session::put('otp_expires_at', now()->addMinutes(3));

        return back()->with('status', 'លេខកូដសម្រាប់ផ្ទៀតផ្ទាត់ ');

    }

    public function verifyOtp(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'otp' => 'required|digits:6',
            'phone' => 'required|numeric'
        ]);

        if (
            \Session::get('otp') == $request->otp && \Session::get('otp_phone') == $request->phone &&
            now()->lessThan(\Session::get('otp_expires_at'))
        ) {
            $user = Customer::firstOrCreate(['phone_number' => $request->phone]);
            \Auth::guard('customer')->login($user);
            \Session::forget(['otp', 'otp_sent', 'otp_phone', 'otp_expires_at']);
            return redirect()->intended()->with('success', 'ចូលដោយ OTP ជោគជ័យ');
        }
        return back()->withErrors(['otp' => 'OTP មិនត្រឹមត្រូវ ']);

    }

}
