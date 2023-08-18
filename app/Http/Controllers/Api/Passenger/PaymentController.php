<?php

namespace App\Http\Controllers\Api\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        $user = $request->user();
        $amount = $request->input('amount');

        if (!$user->stripe_id) {
            // Create a Stripe customer for the user
            $user->createAsStripeCustomer();
        }

        $payment = $user->pay($amount);

        return response()->json(['client_secret' => $payment->client_secret]);
    }
}
