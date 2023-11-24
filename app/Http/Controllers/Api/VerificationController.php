<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use Illuminate\Support\Carbon;

class VerificationController extends Controller
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
        $url = env('APP_URL') . '/verify-email?email=' . $email . '&otp=' . $otp;
        Mail::to($email)->send(new VerificationEmail($url));  // Create a Mailable for this
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

                return response()->json(['status' => 200, 'message' => 'OTP sent successfully']);                # code...
            } else {
                return response()->json(['status' => 204, 'message' => 'Email not exist']);                # code...

            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json(['status' => 500, 'message' => 'Internal server error']);
        }
    }
    public function verify(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'otp' => 'required',
            ]);

            // $isValidOTP = $this->verifyOTP($request->input('email'), $request->input('verification_otp'));
            $user = User::where('email', $request->input('email'))->where('otp', $request->input('otp'))->first();

            if ($user) {
                $user = User::where('email', $request->input('email'))->first();
                $user->email_verified_at = Carbon::now();;
                $user->otp = null;
                $user->save();
                return response()->json(['status' => 200, 'message' => 'Your Email has been Verified Successfully']);
            } else {
                return response()->json(['status' => 401, 'message' => 'OTP is not correct or already been verified.']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'message' => 'Something went wrong']);
        }
    }
}
