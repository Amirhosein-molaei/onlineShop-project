<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\User\Otp;
use Illuminate\Support\Str;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class OTPLoginController extends Controller
{
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|regex:/^09[0-9]{9}$/'
        ]);

        $mobileNumber = $request->input('mobile');
        // find user by mobile or create it, if it doesn't exsist
        $user = User::firstOrCreate(['mobile' => $mobileNumber]);
        // delete old otp's
        Otp::where('user_id', $user->id)->delete();
        
        $otpCode = rand(1000, 9999);
        $token = Str::random(32);

        $lastOtp = Otp::where('user_id', $user->id)->orderByDesc('created_at')->withTrashed()->first();
        $lastOtpTry = strtotime($lastOtp['created_at']);
        $now = time();
        if ($now - $lastOtpTry <= 120) {
            return redirect()->back()->with('error', 'پس از 2 دقیقه مجددا تلاش نمایید');
        }

        Otp::create([
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'used' => 0,
            'attempts' => 0,
        ]);
        //send sms and take user to confirm-code page
        try {
            $this->smsService->sendOtpSms($mobileNumber, $otpCode);
            return redirect()->route('otp.verify.form', ['token' => $token])->with('message', 'کد برای شما ارسال شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطا در ارسال کد' . $e->getMessage());
        }
    }

    public function showVerifyForm($token)
    {
        $otp = Otp::where('token', $token)->first();
        // if otp is used or token is wrong user will be redirected back to login
        if (!$otp or $otp->used) {
            return redirect()->route('login')->with('error', 'کد نامعتبر');
        }
        
        return view('auth.verify', ['token' => $token]);
    }
    
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'token' => 'required|exists:otps,token',
            'otp' => 'required|digits:4'
        ]);
        
        $otp = Otp::where('token', $request->input('token'))->first();
        
        if (!$otp or $otp->used) {
            return redirect()->route('login')->with('error', 'کد نامعتبر');
        }
        
        if ($otp->attempts >= 3) {
            return redirect()->route('login')->with('error', 'تعداد تلاش های شما بیش از حد مجاز است. لطفا مجددا اقدام به دریافت کد تایید کنید');
        }
        
        if ($otp->otp_code != $request->input('otp')) {
            $otp->increment('attempts');
            return redirect()->back()->with('error', 'کد وارد شده اشتباه است');
        }

        $otp->update(['used' => 1]);

        $user = $otp->user;
        Auth::login($user);

        redirect()->route('home');
    }
}