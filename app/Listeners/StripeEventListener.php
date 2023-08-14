<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Handle the invoice.payment_succeeded webhook.
     *
     * @param  WebhookReceived  $event
     * @return void
     */
    public function handleInvoicePaymentSucceeded(WebhookReceived $event)
    {
        // Retrieve the event data from the webhook payload
        $payload = $event->payload;

        // Perform your custom logic based on the event data
        // Example: Update user's wallet balance, send notifications, etc.

        // Log the webhook event
        Log::info('Invoice Payment Succeeded: ' . json_encode($payload));
    }
}
