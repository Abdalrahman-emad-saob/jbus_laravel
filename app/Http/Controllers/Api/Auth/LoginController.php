<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            if($user->id)
            $token = $user->createToken('authToken')->plainTextToken;
            if($user->role == User::$passenger)
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user,
                'role' => DB::table('passenger_profiles')->where('passenger_id', $user->id)->get()
            ]);
            else if($user->role == User::$driver)
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user,
                // 'role' => DB::table('driver_profile')->where('id', $user->id)->get()
            ]);
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

