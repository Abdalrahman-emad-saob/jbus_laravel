<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


class SocialiteController extends Controller
{
    // TODO: Google and Facebook OAuth functionalities

    public function oAuthRedirect(Request $request, String $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
    }

    public function oAuthCallback(Request $request, String $provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $password = Str::random(10);

        $user = User::firstOrCreate([
            'email' => $socialUser->email,
        ], [
            'name' => $socialUser->name,
            'password' => Hash::make($password), // ??
            'role_id' => 3,
        ]);


        if ($user->wasRecentlyCreated) {
            Mail::to($user->email)->send(new WelcomeEmail($user, $password));
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'success' => true,
        ]);
    }
}
