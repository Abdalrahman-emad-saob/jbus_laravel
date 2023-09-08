<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            // Determine the user's role and response data
            $responseData = [
                'success' => true,
                'token' => $token,
                'user' => $user,
            ];

            if ($user->role == User::$passenger) {
                $responseData['profile'] = $user->passengerProfile;
            }

            return response()->json($responseData);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 422);
    }



    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'logged out successfully'
        ]);
    }
}
