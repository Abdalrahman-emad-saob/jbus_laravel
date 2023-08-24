<?php
// app/Http/Controllers/Api/UpdateController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function createOTP(Request $request)
    {
        // Verify that the email is unique in the users table
        $exists = !(User::where('email', $request->email)->doesntExist());

        if (!$exists) {
            return response()->json([
                'message' => 'Email doesn\'t exist in the users table.',
            ], 400);
        }

        // Generate OTP
        $otp = mt_rand(1000, 9999);

        // Create OTP record
        $otpRecord = OTP::create([
            'number' => $otp,
            'email' => $request->email,
        ]);

        // Send OTP to the user's email
        // Mail::to($request->email)->send(new OtpMail($otp));

        return response()->json([
            'message' => 'Please check your active email for the OTP.',
            'otp' => $otp,
        ], 201);
    }



    public function updateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'new_email' => 'required|email|unique:users,email',
            'password' => 'required',
            'otp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $validator->validated();

        // Check if email and password are correct
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        // Verify OTP
        $otpRecord = OTP::where('email', $data['email'])
            ->where('number', $data['otp'])
            ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }

        // Delete the OTP record
        $otpRecord->delete();

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->email = $request->new_email;
            $user->email_verified_at = now();
            $user->save();
            // Return success response
        }

        //add response
        return response()->json(['message' => 'Email updated successfully'], 200);
    }



    public function updatePhoneNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone_number' => [
                'required',
                'regex:/^07[789]\d{7}$/', // 077xxxxxxx 078xxxxxxx 079xxxxxxx
                'unique:users,phone_number'
            ],
            'password' => 'required',
            'otp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $validator->validated();

        // Check if email and password are correct
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        // Verify OTP
        $otpRecord = OTP::where('email', $data['email'])
            ->where('number', $data['otp'])
            ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }

        // Delete the OTP record
        $otpRecord->delete();

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->phone_number = $request->phone_number;
            $user->save();
            // Return success response
        }

        //add response
        return response()->json(['message' => 'Phone number updated successfully'], 200);
    }
}
