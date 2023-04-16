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

            if ($billingReason == 'subscription_create'){
                $this->handleSubscriptionCreated($event->payload);
            }

            if ($billingReason == 'subscription_cycle') {
                $this->handleSubscriptionRenewal($event->payload);
            }
        }

        if ($event->payload['type'] === 'customer.subscription.updated') {
            $this->handleChangeOfPlan($event->payload);
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

                $planKey = $this->mapStripePlanIdToConfigKey($stripePlanId);

                $plan_name = $this->getPlanName($planKey);
                $newPlanCredits = $this->getPlanCredits($planKey);

                $currentPeriodStart = Carbon::createFromTimestamp($data['data']['object']['current_period_start']);
                $currentPeriodEnd = Carbon::createFromTimestamp($data['data']['object']['current_period_end']);

                if ($billingInterval === 'year') {
                    $newPlanCredits *= 12;
                }
                // TODO: link with subscription_id

                $team->teamCredits()->updateOrCreate(
                    ['team_id' => $team->id],
                    [
                        'plan' => $plan_name,
                        'credits' => $newPlanCredits,
                        'credits_used' => 0,
                        'original_plan_credits' => $newPlanCredits,
                        'interval' => $billingInterval,
                        'start_date' => $currentPeriodStart,
                        'expiration_date' => $currentPeriodEnd,
                    ]
                );

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

            if ($team) {

                $billingInterval = $data['data']['object']['items']['data'][0]['plan']['interval'];

                $currentPeriodStart = Carbon::createFromTimestamp($data['data']['object']['current_period_start']);
                $currentPeriodEnd = Carbon::createFromTimestamp($data['data']['object']['current_period_end']);

                $teamCredits = $team->teamCredits;

                $planCredits = $teamCredits->original_plan_credits;

                if ($billingInterval === 'year') {
                    $planCredits *= 12;
                }

                $teamCredits->update([
                    'credits' => $planCredits,
                    'credits_used' => 0,
                    'start_date' => $currentPeriodStart,
                    'expiration_date' => $currentPeriodEnd,
                ]);
            }

            return $this->success();

        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return $this->failure();
        }
    }

    public function handleChangeOfPlan($data): void
    {
        // Idea: log plan changes
        $stripeCustomerId = $data['data']['object']['customer'];
        $team = $this->getTeamByStripeId($stripeCustomerId);

        if ($team){
            $billingInterval = $data['data']['object']['items']['data'][0]['plan']['interval'];

            //$previousPlanId = $data['data']['previous_attributes']['items']['data'][0]['plan']['id'];
            $newPlanId = $data['data']['object']['items']['data'][0]['plan']['id'];

            $currentPeriodEnd = Carbon::createFromTimestamp($data['data']['object']['current_period_end']);
            $currentPeriodStart = Carbon::createFromTimestamp($data['data']['object']['current_period_start']);

            $newPlanKey = $this->mapStripePlanIdToConfigKey($newPlanId);

            $teamCredits = $team->teamCredits;

            $newPlanName = $this->getPlanName($newPlanKey);
            $newPlanCredits = $this->getPlanCredits($newPlanKey);

            if ($billingInterval === 'year') {
                $newPlanCredits *= 12;
            }

            $remainingCredits = $teamCredits->credits;

            // Add the remaining credits from the old plan to the new plan credits?
            // are we supposed to merge the credits if the plan upgrade is pro rata?
            $totalCredits = $remainingCredits + $newPlanCredits;

            $team->teamCredits()->update(
                [
                    'plan' => $newPlanName,
                    'credits' => $newPlanCredits,
                    'credits_used' => 0, //reset credit usage
                    'original_plan_credits' => $newPlanCredits,
                    'interval' => $billingInterval,
                    'start_date' => $currentPeriodStart,
                    'expiration_date' => $currentPeriodEnd,
                ]
            );

            $subscription = Subscription::where('team_id', $team->id)->first();
            if ($subscription) {
                $subscription->name = $newPlanName;
                $subscription->save();
            }

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

    /**
     * @throws \Exception
     */
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
        throw new \Exception('Stripe plan was not found');
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
