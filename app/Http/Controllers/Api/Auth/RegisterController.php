<?php


namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
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
    $isUnique = User::where('email', $request->email)->doesntExist();

    if (!$isUnique) {
        return response()->json([
            'message' => 'Email already exists in the users table.',
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
        'message' => 'Please check your email for OTP.',
        'otp' => $otp,
    ], 201);
}


    public function createUser(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'otp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $validatedData = $validator->validated();

        $otpRecord = OTP::where('email', $validatedData['email'])
        ->where('number', $validatedData['otp'])
        ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }

        // Delete the OTP record
        $otpRecord->delete();

        $validatedData['role'] = User::$passenger;


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => User::$passenger,
            'email_verified_at'=>now(),
        ]);

        //add response
        return response()->json(['message' => 'Account created and verified'], 200);
    }
}
