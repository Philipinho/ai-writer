<?php

namespace App\Listeners\Stripe;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;

class StripeSubscriptionCancelled implements ShouldQueue
{

    public function handle(WebhookCall $webhookCall)
    {
        $this->handleSubscriptionCancelled($webhookCall->payload['data']['object']);

    }

    protected function handleSubscriptionCancelled($subscriptionData)
    {
        //
        $stripeSubscriptionId = $subscriptionData['id'];

        $subscription = Subscription::where('stripe_id', $stripeSubscriptionId)->first();

        if ($subscription) {
            $subscription->update([
                'stripe_status' => $subscriptionData['status'],
                'ends_at' => $subscriptionData['cancel_at_period_end'] ? Carbon::createFromTimestamp($subscriptionData['current_period_end']) : Carbon::now(),
            ]);
        }
    }

}
