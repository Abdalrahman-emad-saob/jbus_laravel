<?php

namespace App\Listeners;

use App\Models\PassengerProfile;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        $payload = $event->payload;

        if ($payload['type'] === 'payment_intent.succeeded') {
            $paymentIntent = $payload['data']['object'];

            $user = User::where('stripe_id', $paymentIntent['customer'])->first();

            if ($user) {
                if (!$user->passengerProfile()->exists()) {
                    $passProfile = new PassengerProfile();
                    $passProfile->passenger_id = $user->id;
                    $passProfile->save();
                }
                $user->passengerProfile->wallet += $paymentIntent['amount'];
                $user->passengerProfile->save();
            }
        }
    }
}
