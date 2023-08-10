<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordEmail;


class ForgotPasswordController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        $token = $this->broker()->createToken($user);
        $password = $request->password;

        // Mail::to($user->email)->send(new ResetPasswordEmail($user, $token, $password));

        return response()->json([
            'message' => 'Password reset link sent successfully',
            'email' => $request->email,
            'token' => $token,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$this->broker()->tokenExists($user, $request->token)) {
            return response()->json(['message' => 'Invalid token'], 400);
        }
        if ($request->password !== $request->password_confirmation) {
            return response()->json(['message' => 'Password confirmation does not match'], 400);
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
