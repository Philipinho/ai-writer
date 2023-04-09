<?php

namespace App\Listeners\Stripe;

use App\Models\Team;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class PaymentsListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle received Stripe webhooks.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
            Log::info("Payment: ", $event->payload);
        }

        if ($event->payload['type'] === 'customer.subscription.created') {
            $this->handleSubscriptionCreated($event->payload);
        }
    }

    public function handleSubscriptionCreated($data)
    {
        try {
            $stripeCustomerId = $data['data']['object']['customer'];
            $team = Team::where('stripe_id', $stripeCustomerId)->first();

            if ($team) {
                $stripePlanId = $data['data']['object']['items']['data'][0]['plan']['id'];
                $billingInterval = $data['data']['object']['items']['data'][0]['plan']['interval']; // 'month' or 'year'

                $newSubscriptionPlanKey = $this->mapStripePlanIdToConfigKey($stripePlanId);

                $plan_name = config("stripe.plans.{$newSubscriptionPlanKey}.name");
                $newPlanCredits = config("stripe.plans.{$newSubscriptionPlanKey}.credits");
                $currentPeriodEnd = $data['data']['object']['current_period_end'];

                if ($billingInterval === 'year') {
                    $newPlanCredits *= 12;
                }

                $team->teamCredits()->firstOrCreate(
                    ['team_id' => $team->id],
                    [
                        'subscription_plan' => $plan_name,
                        'credits' => $newPlanCredits,
                        'original_plan_credits' => $newPlanCredits,
                        'interval' => $billingInterval,
                        'expiration_date' => Carbon::createFromTimestamp($currentPeriodEnd),
                    ]
                );
                // Cancel the old subscription plan if the team has any existing plan
                //$this->cancelOldPlanIfNeeded($team);
            }

            return $this->success();
        } catch (\Exception $e) {
            Log::info($e->getMessage());

            return $this->failure();
        }

    }

    public function handleSubscriptionRenewal($data): \Illuminate\Http\JsonResponse
    {
        try {
            $stripeCustomerId = $data['data']['object']['customer'];
            $team = Team::where('stripe_id', $stripeCustomerId)->first();

            // Get the new subscription's current period end (due date) from the webhook data
            $currentPeriodEnd = $data['data']['object']['current_period_end'];

            // Find the team credits record
            $teamCredits = $team->teamCredits;

            // Renew the credits based on the subscription plan
            if ($teamCredits) {
                //$planCredits = config("subscriptions.plans.{$teamCredits->subscription_plan}.credits");
                $planCredits = $teamCredits->original_plan_credits;

                // Check if the subscription is yearly
                $isYearly = str_contains($teamCredits->subscription_plan, 'year');
                if ($isYearly) {
                    $planCredits *= 12;
                }

                $teamCredits->update([
                    'credits' => $planCredits,
                    'expiration_date' => Carbon::createFromTimestamp($currentPeriodEnd),
                ]);
            }

            return $this->success();

        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return $this->failure();
        }
    }

    private function mapStripePlanIdToConfigKey($stripePlanId): int|string|null
    {
        $stripePlansConfig = config('stripe.plans');

        foreach ($stripePlansConfig as $planKey => $planConfig) {
            // Check if the given Stripe plan ID matches the month_id or yearly_id in the plan config
            if (
                isset($planConfig['monthly_id']) && $stripePlanId === $planConfig['monthly_id'] ||
                isset($planConfig['yearly_id']) && $stripePlanId === $planConfig['yearly_id']
            ) {
                // Return the corresponding plan key (e.g., 'basic', 'standard')
                return $planKey;
            }
        }
        return null;
    }

    public function cancelOldPlanIfNeeded(Team $team): void
    {
        // Check if the team has multiple active subscriptions
        $activeSubscriptions = $team->subscriptions()->active()->get();

        if ($activeSubscriptions->count() > 1) {
            // Find the oldest active subscription and cancel it
            $oldestSubscription = $activeSubscriptions->sortBy('created_at')->first();
            $oldestSubscription->cancel();
        }
    }

    private function success(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['success' => true]);
    }

    private function failure(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['success' => false, 500]);
    }

}
