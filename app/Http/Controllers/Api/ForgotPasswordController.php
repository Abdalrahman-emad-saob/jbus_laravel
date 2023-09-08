<?php


namespace App\Http\Controllers\Api;

use App\{Http\Controllers\Controller, Mail\ResetPasswordEmail, Models\User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

// TODO: rework to OTP
class ForgotPasswordController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();


        $token = $this->broker()->createToken($user);
        // TODO: make email
        Mail::to($user->email)->send(new ResetPasswordEmail($user, route('reset-password', ['token' => $token])));

        return response()->json([
            'message' => 'Password reset link sent successfully',
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$this->broker()->tokenExists($user, $request->token)) {
            return response()->json(['message' => 'Invalid token'], 400);
        }

        $response = $this->broker()->reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function ($user, $password) { //use ($request)
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $response == Password::PASSWORD_RESET
            ? response()->json([
                'message' => 'Password reset successfully',
                'password' => $request->password
            ])
            : response()->json(['message' => 'Unable to reset password'], 400);
    }


    public function broker()
    {
        return Password::broker();
    }
}
