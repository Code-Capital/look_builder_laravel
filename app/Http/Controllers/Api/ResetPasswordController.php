<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;

class ResetPasswordController extends Controller
{
    private function verifyOTP($email, $otp)
    {
        if (Cache::has('otp_' . $email)) {
            $storedOTP = Cache::get('otp_' . $email);

            return $storedOTP === $otp;
        }

        return false; // OTP not found or expired
    }
    public function generateOTP()
    {
        return Str::random(6); // You can adjust the OTP length as needed
    }
    public function sendOTP($email, $otp)
    {
        Mail::to($email)->send(new ResetPasswordMail($otp)); // Create a Mailable for this
    }
    public function sendOTPRequest(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            $email = $request->input('email');
            $otp = $this->generateOTP();

            $user = User::where('email', $email)->first();
            if ($user != null) {
                $user->otp = $otp;
                $user->save();

                $this->sendOTP($email, $otp);
                return response()->json(['status' => 200, 'message' => 'OTP sent successfully']);
            } else {
                return response()->json(['status' => 204, 'message' => 'Email does not exist.']);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json(['status' => 500, 'message' => 'Internal server error.']);
        }
    }
    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'otp' => 'required',
                'password' => 'required|min:8',
            ]);

            $isValidOTP = $this->verifyOTP($request->input('email'), $request->input('otp'));
            $user = User::where('email', $request->input('email'))->where('otp', $request->input('otp'))->first();

            if ($user) {
                $user = User::where('email', $request->input('email'))->first();
                $user->password = Hash::make($request->input('password'));
                $user->otp = null;
                $user->save();
                return response()->json(['status' => 200, 'message' => 'Password reset successfully']);
            }
            return response()->json(['status' => 401, 'message' => 'Your otp is not valid']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'message' => 'Internal server error.']);
        }
    }
}
