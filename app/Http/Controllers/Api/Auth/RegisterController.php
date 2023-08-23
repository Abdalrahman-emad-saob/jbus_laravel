<?php

// namespace App\Http\Controllers\Api\Auth;

// use App\Http\Controllers\Controller;
// use App\Mail\OtpMail; // Make sure to import the OtpMail class
// use App\Models\OTP;
// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Mail; // Import the Mail facade
// use Illuminate\Support\Str;

// class RegisterController extends Controller
// {
//     public function register(Request $request)
//     {
//         $validatedData = $request->validate([
//             'name' => 'required|string',
//             'email' => 'required|email|unique:users,email',
//             'password' => 'required|min:6',
//         ]);

//         $validatedData['role'] = 3;

//         $user = User::create($validatedData);

//         $otp = mt_rand(100000, 999999); // Generate a random 6-digit OTP

//         // Save the OTP in the OTP model
//         $otp = OTP::create([
//             'number' => $otp,
//             'passenger_id' => $user->id,
//             'email' => $user->email,
//         ]);
//         $otp->save();

//         return response()->json([
//             'message' => 'Registration successful. Please check your email for OTP.',
//         ], 201);
//     }
// }


namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function register(Request $request)
    {

        //verify email is unique


        $otp = mt_rand(0000, 9999);

        $otpRecord = OTP::create([
            'number' => $otp,
            'email' => $request->email,
        ]);

        // Send OTP to the user's email
        // Mail::to($user->email)->send(new OtpMail($otp));

        return response()->json([
            'message' => 'Please check your email for OTP.',
            'otp' => $otp,
        ], 201);
    }


    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $validator->validated();

        $otpRecord = OTP::where('email', $data['email'])
        ->where('number', $data['otp'])
        ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }

        // Mark the user as verified

        // Delete the OTP record
        $otpRecord->delete();

        return response()->json(['message' => 'OTP verification successful'], 200);
    }


    public function createUser(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $validatedData = $validator->validated();

        $validatedData['role'] = 3;


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => User::$passenger,
            'email_verified_at'=>now(),
        ]);

    }
}
