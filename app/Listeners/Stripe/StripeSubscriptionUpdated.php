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
            $subscription = $this->updateSubscription($payload);
            $this->saveUpdatedInvoice($payload);

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

                $subscription->plan_id = $newPlan->id;
                $subscription->save();

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
            // prevent old webhooks from making any chnages
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

        return $subscription;

    }

    protected function saveUpdatedInvoice($payload)
    {
        $invoiceData = $payload['data']['object'];

        $invoiceId = $invoiceData['latest_invoice'];
        $stripeCustomerId = $invoiceData['customer'];

        $stripeSubscriptionId = $invoiceData['id'];

        $stripePlanId = $invoiceData['items']['data'][0]['plan']['id'];

        if (Invoice::where('invoice_id', $invoiceId)->exists()) {
            throw new \Exception('Invoice already saved');
        }

        $teamId = Team::where('stripe_id', $stripeCustomerId)->pluck('id')->first();
        $subscriptionId = Subscription::where('stripe_id', $stripeSubscriptionId)->pluck('id')->first();
        $plan = Plan::findByStripePriceId($stripePlanId);

        $invoice = new Invoice([
            'team_id' => $teamId,
            'subscription_id' => $subscriptionId,
            'plan_id' => $plan->id,
            'payment_provider' => 'stripe',
            'invoice_id' => $invoiceId,
            'customer' => $stripeCustomerId,
            'subscription' => $stripeSubscriptionId,
            'subscription_item' => $invoiceData['items']['data'][0]['id'],
            'product' => $invoiceData['items']['data'][0]['plan']['product'],
            'price_id' => $stripePlanId,
            'currency' => $invoiceData['currency'],
            'amount' => $invoiceData['items']['data'][0]['plan']['amount'] / 100,
           // 'invoice_url' => $invoiceData['hosted_invoice_url'],
            'status' => 1,
        ]);

        $invoice->save();
    }

}
