<?php

namespace App\Listeners\Stripe;

use App\Models\Team;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;
use Laravel\Cashier\Subscription;
use Laravel\Cashier\SubscriptionItem;

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
            $billingReason = $event->payload['data']['object']['billing_reason'];

            if ($billingReason == 'subscription_cycle') {
                $this->handleSubscriptionRenewal($event->payload);
            }
        }

        if ($event->payload['type'] === 'customer.subscription.created') {
            $this->handleSubscriptionCreated($event->payload);
        }

        if ($event->payload['type'] === 'customer.subscription.updated') {
            // Plan upgrade
            $this->handlePlanUpgrade($event->payload);
        }

    }

    public function handleSubscriptionCreated($data): \Illuminate\Http\JsonResponse
    {
        try {
            $stripeCustomerId = $data['data']['object']['customer'];
            $team = $this->getTeamByStripeId($stripeCustomerId);

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
                // TODO: link with subscription_id

                $team->teamCredits()->updateOrCreate(
                    ['team_id' => $team->id],
                    [
                        'plan' => $plan_name,
                        'credits' => $newPlanCredits,
                        'original_plan_credits' => $newPlanCredits,
                        'interval' => $billingInterval,
                        'start_date' => Carbon::now(),
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
            $team = $this->getTeamByStripeId($stripeCustomerId);

            // Get the new subscription's current period end (due date) from the webhook data
            $currentPeriodEnd = $data['data']['object']['current_period_end'];
            $billingInterval = $data['data']['object']['items']['data'][0]['plan']['interval'];

            // Find the team credits record
            $teamCredits = $team->teamCredits;

            // Renew the credits based on the subscription plan
            if ($teamCredits) {
                //$planCredits = config("subscriptions.plans.{$teamCredits->subscription_plan}.credits");
                $planCredits = $teamCredits->original_plan_credits;

                // Check if the subscription is yearly
                if ($billingInterval === 'year') {
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

    public function handlePlanUpgrade($data): void
    {
        // Idea: log plan changes
        $stripeCustomerId = $data['data']['object']['customer'];
        $team = $this->getTeamByStripeId($stripeCustomerId);

        $billingInterval = $data['data']['object']['items']['data'][0]['plan']['interval']; // 'month' or 'year'

        $previousPlanId = $data['data']['previous_attributes']['items']['data'][0]['plan']['id'];
        $newPlanId = $data['data']['object']['items']['data'][0]['plan']['id'];

        $currentPeriodEnd = Carbon::createFromTimestamp($data['data']['object']['current_period_end']);
        $currentPeriodStart = Carbon::createFromTimestamp($data['data']['object']['current_period_start']);

        $newSubscriptionPlanKey = $this->mapStripePlanIdToConfigKey($newPlanId);

        if ($team){
            // things to check
            // if the upgrade is on the same product but different plan interval
            // if the upgrade is for different product plans, e.g from (basic yearly to standard yearly).

            $teamCredits = $team->teamCredits;

            $newPlanName = $this->getPlanName($newSubscriptionPlanKey);
            $newPlanCredits = $this->getPlanCredits($newSubscriptionPlanKey);

            if ($billingInterval === 'year') {
                $newPlanCredits *= 12;
            }

            $remainingCredits = $teamCredits->credits;

            // Add the remaining credits from the old plan to the new plan credits
            // are we supposed to merge the credits if the plan upgrade is prorata?
            $totalCredits = $remainingCredits + $newPlanCredits;

            $team->teamCredits()->update(
                [
                    'plan' => $newPlanName,
                    'credits' => $newPlanCredits,
                    'original_plan_credits' => $newPlanCredits,
                    'interval' => $billingInterval,
                    'start_date' => $currentPeriodStart,
                    'expiration_date' => $currentPeriodEnd,
                ]
            );

            $subscription = Subscription::where('team_id', $team->id)->first();
            if ($subscription) {
                // Update the subscription name
                // do we have to update it on Stripe too?
                $subscription->name = $newPlanName;
                $subscription->save();
            }

            // think about the percentage if we combine previous credits

            // things to update
            // plan name
            // credits
            // original_plan_credits
            // interval
        }
    }

    private function getPlanCredits($planKey){
        return config("stripe.plans.{$planKey}.credits");
    }

    private function getPlanName($planKey){
        return config("stripe.plans.{$planKey}.name");
    }

    protected function getTeamByStripeId($stripeId)
    {
        return Team::where('stripe_id', $stripeId)->first();
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
                // Return the corresponding plan key (e.g., '0' for basic, '1' for standard)
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
