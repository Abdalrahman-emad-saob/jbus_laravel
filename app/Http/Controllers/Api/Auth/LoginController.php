<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->id)
                $token = $user->createToken('authToken')->plainTextToken;
            if ($user->role == User::$passenger)
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => $user,
                    'profile' => $user->passengerProfile
                ]);
            else if ($user->role == User::$driver) {
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => $user,
                    // 'role' => $user->driverProfile
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }


    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'logged out successfully'
        ]);
    }
}
