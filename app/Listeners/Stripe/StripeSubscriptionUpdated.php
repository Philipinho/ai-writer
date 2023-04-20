<?php

namespace App\Listeners\Stripe;

use App\Models\Invoice;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Team;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Models\WebhookCall;

class StripeSubscriptionUpdated implements ShouldQueue
{

    public function handle(WebhookCall $webhookCall)
    {

        if ($this->isChangeOfStatus($webhookCall->payload)){
            $this->updateSubscriptionStatus($webhookCall->payload['data']['object']);
        } else {
            $this->handleChangeOfPlan($webhookCall->payload);
        }
    }

    protected function isChangeOfStatus($payload): bool
    {
        return isset($payload['data']['previous_attributes']['status']);
    }

    protected function updateSubscriptionStatus($payload): void
    {
        Subscription::where('stripe_id', $payload['id'])
            ->update(['stripe_status' => $payload['status']]);
    }

    protected function handleChangeOfPlan($payload): void
    {
        $data = $payload['data']['object'];
        $stripeCustomerId = $data['customer'];

        try {
            $this->updateSubscription($payload);

            $team = Team::where('stripe_id', $stripeCustomerId)->first();

            if ($team) {
                $billingInterval = $data['items']['data'][0]['plan']['interval'];

                $newPlanId = $data['items']['data'][0]['plan']['id'];

                $currentPeriodEnd = Carbon::createFromTimestamp($data['current_period_end']);
                $currentPeriodStart = Carbon::createFromTimestamp($data['current_period_start']);

                $newPlan = Plan::findByStripePriceId($newPlanId);
                $newPlanCredits = $newPlan->credits;

                if ($billingInterval === 'year') {
                    $newPlanCredits *= 12;
                }

                $team->teamCredits()->update(
                    [
                        'plan_id' => $newPlan->id,
                        'credits' => $newPlanCredits,
                        'credits_used' => 0, //reset credit usage
                        'original_plan_credits' => $newPlanCredits,
                        'interval' => $billingInterval,
                        'start_date' => $currentPeriodStart,
                        'expiration_date' => $currentPeriodEnd,
                    ]
                );

            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    protected function updateSubscription($payload)
    {
        $stripeSubscription = $payload['data']['object'];
        $stripeSubscriptionId = $stripeSubscription['id'];

        $subscription = Subscription::where('stripe_id', $stripeSubscriptionId)->first();

        if (!$subscription) {
            throw new \Exception('Subscription not found');
        }

        // Check if the subscription has already been updated
        // more work to do
        if ($subscription->stripe_price_id === $stripeSubscription['items']['data'][0]['price']['id'] &&
            Carbon::parse($subscription->next_payment_date)->eq(Carbon::createFromTimestamp($stripeSubscription['current_period_end']))
        ) {
            throw new \Exception('Subscription already updated');
        }

        $localLatestInvoiceId = Invoice::orderBy('created_at', 'desc')->first()->id;

        $existingInvoice = Invoice::where('invoice_id', $stripeSubscription['latest_invoice'])
            ->whereNotIn('id', [$localLatestInvoiceId])
            ->first();

        if ($existingInvoice){
            // prevent old webhooks from taking effect
            throw new \Exception('This invoice exists - subscription update aborted');
        }

        $subscription->update([
            'stripe_price_id' => $stripeSubscription['items']['data'][0]['price']['id'],
            'stripe_product_id' => $stripeSubscription['items']['data'][0]['price']['product'],
            'interval' => $stripeSubscription['items']['data'][0]['price']['recurring']['interval'],
            'stripe_status' => $stripeSubscription['status'],
            'quantity' => $stripeSubscription['items']['data'][0]['quantity'],
            'next_payment_date' => Carbon::createFromTimestamp($stripeSubscription['current_period_end']),
            'ends_at' => $stripeSubscription['cancel_at_period_end'] ? Carbon::createFromTimestamp($stripeSubscription['current_period_end']) : null,
        ]);

    }

}
