<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // TODO: Google and Facebook OAuth functionalities

    public function oAuthRedirect(Request $request, String $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
    }

    public function oAuthCallback(Request $request, String $provider)
    {

    }
}
