<?php

namespace App\Listeners\Stripe;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Team;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Models\WebhookCall;

class StripeSubscriptionCreated implements ShouldQueue
{

    public function handle(WebhookCall $webhookCall)
    {
        $this->handleSubscriptionCreated($webhookCall->payload);
    }

    protected function handleSubscriptionCreated($payload): string
    {
        $data = $payload['data']['object'];

        try {
            $StripeSubscriptionId = $data['id'];

            $subscription = Subscription::where('stripe_id', $StripeSubscriptionId)->first();
            if ($subscription) {
                return "already processed";
            }

            $stripeCustomerId = $data['customer'];
            $team = Team::where('stripe_id', $stripeCustomerId)->first();

            if ($team) {
                $stripePlanId = $data['items']['data'][0]['plan']['id'];
                $billingInterval = $data['items']['data'][0]['plan']['interval']; // 'month' or 'year'

                $plan = Plan::findByStripePriceId($stripePlanId);

                $planCredits = $plan->credits;

                $currentPeriodStart = Carbon::createFromTimestamp($data['current_period_start']);
                $currentPeriodEnd = Carbon::createFromTimestamp($data['current_period_end']);

                if ($billingInterval === 'year') {
                    $planCredits *= 12;
                }

                $this->insertSubscription($team->id, $plan->id, $data);

                $team->teamCredits()->updateOrCreate(
                    ['team_id' => $team->id],
                    [
                        'plan_id' => $plan->id,
                        'credits' => $planCredits,
                        'credits_used' => 0,
                        'original_plan_credits' => $planCredits,
                        'interval' => $billingInterval,
                        'start_date' => $currentPeriodStart,
                        'expiration_date' => $currentPeriodEnd,
                    ]
                );
                return "processed";
            } else {
                return "team not found";
            }

        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return "failed";
        }
    }

    protected function insertSubscription($teamId, $planId, $subscriptionData): Subscription
    {
        $subscription = new Subscription([
            'team_id' => $teamId,
            'plan_id' => $planId,
            'stripe_customer_id' => $subscriptionData['customer'],
            'stripe_id' => $subscriptionData['id'],
            'stripe_status' => $subscriptionData['status'],
            'stripe_price_id' => $subscriptionData['items']['data'][0]['price']['id'],
            'stripe_product_id' => $subscriptionData['items']['data'][0]['price']['product'],
            'stripe_item_id' => $subscriptionData['items']['data'][0]['id'],
            'amount' => $subscriptionData['items']['data'][0]['price']['unit_amount'] / 100,
            'currency' => $subscriptionData['items']['data'][0]['price']['currency'],
            'quantity' => $subscriptionData['items']['data'][0]['quantity'],
            'interval' => $subscriptionData['items']['data'][0]['price']['recurring']['interval'],
            'payment_provider' => 'stripe',
            'trial_ends_at' => isset($subscriptionData['trial_end']) ? Carbon::createFromTimestamp($subscriptionData['trial_end']) : null,
            'start_date' => Carbon::createFromTimestamp($subscriptionData['start_date']),
            //'ends_at' => isset($subscriptionData['cancel_at']) ? Carbon::createFromTimestamp($subscriptionData['cancel_at']) : null,
            'next_payment_date' => isset($subscriptionData['current_period_end']) ? Carbon::createFromTimestamp($subscriptionData['current_period_end']) : null,
            'status' => 1,
        ]);

        $subscription->save();

        return $subscription;
    }

}
