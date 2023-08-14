<?php

namespace App\Http\Controllers\Api\Passenger;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Http\Controllers\WebhookController;

class StripeController extends Controller
{
    /**
     * Handle incoming Stripe webhooks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleWebhook(Request $request)
    {

        // Process the incoming webhook event
        $response = $this->processWebhook($request);

        return $response;
    }


    /**
     * Process the incoming Stripe webhook event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function processWebhook(Request $request)
    {
        // Handle the Stripe webhook event based on the event type
        // You can access the Stripe event data using $request->all()
        Log::info('stripe', [$request]);
        // Example: Handle a charge succeeded event
        if ($request->event === 'payment_intent.succeeded') {
            // Retrieve the event data
            $eventData = $request->all();

            // Get the charge object from the event data
            $chargeData = $eventData['data']['object'];

            // Access the user who was charged (Stripe customer ID)
            $customerId = $chargeData['customer'];

            // Access the amount charged (in cents)
            $amountCharged = $chargeData['amount'];

            // Retrieve your application's user based on the Stripe customer ID
            // Assuming your user model has a 'stripe_customer_id' field
            $user = User::where('stripe_customer_id', $customerId)->first();

            if ($user) {
                // Update your database with the charge information
                // Example: Update user's wallet balance, transaction history, etc.

                Log::info("stripe", [$user]);
            }
        }

        // Return a successful response to Stripe
        return response()->json(['message' => 'Webhook Handled']);
    }

    public function purchase(Request $request)
    {
        try {
            // Assuming you have a user model and the user is authenticated
            $user = $request->user();

            if (!$user->stripe_id) {
                // Create a Stripe customer for the user
                $stripeCustomer = $user->createAsStripeCustomer();

                // Update the user's Stripe customer ID
                $user->update(['stripe_id' => $stripeCustomer->id]);
            }

            // Validate the request (ensure you receive the payment method ID)
            $this->validate($request, [
                'amount' => 'required|integer',
            ]);

            // Charge the user
            $payment = $user->pay($request->amount, [
                // You can pass additional options as needed
                'description' => 'Added ' . $request->amount / 10 . '$ to your account wallet',
            ]);

            // Handle successful charge (update user's wallet balance, send confirmation, etc.)
            return response()->json(['client_secret' => $payment->client_secret], 200);
        } catch (\Exception $e) {
            // Handle error (log, notify, etc.)
            return response()->json(['message' => 'Charge failed', 'error' => $e->getMessage()], 400);
        }
    }
}
