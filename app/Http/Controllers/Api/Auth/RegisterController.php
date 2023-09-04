<?php


namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Mail\WelcomeEmail;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function createOTP(Request $request)
    {
        // Verify that the email is unique in the users table
        // $isUnique = User::where('email', $request->email)->doesntExist();

        // if (!$isUnique) {
        //     return response()->json([
        //         'message' => 'Email already exists in the users table.',
        //     ], 400);
        // }

        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email'
        ]);


        // Generate OTP
        $otp = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);

        // Create OTP record
        $otpRecord = OTP::create([
            'number' => $otp,
            'email' => $validatedData['email'],
        ]);


        // Send OTP to the user's email
        Mail::to($request->email)->send(new WelcomeEmail(['name' => $otpRecord['email']], $otpRecord['number']));

        return response()->json([
            'message' => 'Please check your email for OTP.',
        ], 201);
    }


    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'otp' => 'required',
        ]);


        $otpRecord = OTP::where('email', $validatedData['email'])
            ->where('number', $validatedData['otp'])
            ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'mismatch'], 400);
        }

        // Delete the OTP record
        $otpRecord->delete();


        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'email_verified_at' => now(),
        ]);

        //add response
        return response()->json(['message' => 'Account created and verified'], 200);
    }
}
