<?php

namespace App\Listeners\Stripe;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Team;
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
                'status' => 0, // 1 for active
                'stripe_status' => $subscriptionData['status'],
                'ends_at' => $subscriptionData['cancel_at_period_end'] ? Carbon::createFromTimestamp($subscriptionData['current_period_end']) : Carbon::now(),
            ]);

            // TODO: look into this again
            // downgrade to free plan
            $team = Team::where('id', $subscription->team_id)->first();

            $freePlan = Plan::where('free', true)->first();

            $team->teamCredits()->firstOrCreate(
                ['team_id' => $team->id],
                [
                    'plan_id' => $freePlan->id,
                    'credits' => $freePlan->credits,
                    'credits_used' => 0,
                    'original_plan_credits' => $freePlan->credits,
                    'interval' => 'month',
                    'start_date' => \Illuminate\Support\Carbon::now(),
                    'expiration_date' => Carbon::now()->addMonth(),
                ]
            );

        }
    }

}
