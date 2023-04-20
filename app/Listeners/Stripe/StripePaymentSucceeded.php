<?php

namespace App\Listeners\Stripe;

use App\Models\Invoice;
use App\Models\Subscription;
use App\Models\Team;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Models\WebhookCall;

class StripePaymentSucceeded implements ShouldQueue
{

    public function handle(WebhookCall $webhookCall)
    {
        $billingReason = $webhookCall->payload['data']['object']['billing_reason'];

        if ($billingReason == 'subscription_cycle') {
            $this->handleSubscriptionRenewal($webhookCall->payload);
        } else {
            $this->handleInvoice($webhookCall->payload);
        }
    }

    protected function handleSubscriptionRenewal($payload)
    {

        try {
            $data = $payload['data']['object'];
            $this->updateSubscription($data);

            $this->saveInvoice($payload);

            $stripeCustomerId = $data['customer'];
            $team = Team::where('stripe_id', $stripeCustomerId)->first();

            if ($team) {
                $billingInterval = $data['items']['data'][0]['plan']['interval'];

                $currentPeriodStart = Carbon::createFromTimestamp($data['current_period_start']);
                $currentPeriodEnd = Carbon::createFromTimestamp($data['current_period_end']);

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

        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    private function updateSubscription($payload)
    {
        $subscriptionData = $payload['data']['object'];

        $subscriptionId = $subscriptionData['subscription'];
        $subscription = Subscription::where('stripe_id', $subscriptionId)->first();

        if (!$subscription) {
            throw new \Exception('Subscription not found');
        }

        $subscription->stripe_status = 'active';
        $subscription->next_payment_date = isset($subscriptionData['lines']['data'][0]['period']['end']) ? Carbon::createFromTimestamp($subscriptionData['lines']['data'][0]['period']['end']) : null;

        if (isset($subscriptionData['cancel_at'])) {
            $subscription->ends_at = Carbon::createFromTimestamp($subscriptionData['cancel_at']);
        }

        $subscription->save();
    }

    protected function handleInvoice($payload)
    {
        try {
            $this->saveInvoice($payload);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    protected function saveInvoice($payload)
    {
        // link it to a plan
        $invoiceData = $payload['data']['object'];
        $stripeCustomerId = $invoiceData['customer'];
        $stripeSubscriptionId = $invoiceData['subscription'];

        if (Invoice::where('invoice_id', $invoiceData['id'])->exists()) {
            throw new \Exception(' invoice already exists');
        }

        $teamId = Team::where('stripe_id', $stripeCustomerId)->pluck('id')->first();
        $subscriptionId = Subscription::where('stripe_id', $stripeSubscriptionId)->pluck('id')->first();

        $invoice = new Invoice([
            'team_id' => $teamId,
            'subscription_id' => $subscriptionId,
            'payment_provider' => 'stripe',
            'invoice_id' => $invoiceData['id'],
            'customer' => $stripeCustomerId,
            'subscription' => $stripeSubscriptionId,
            'subscription_item' => $invoiceData['lines']['data'][0]['subscription_item'],
            'product' => $invoiceData['lines']['data'][0]['price']['product'],
            'price_id' => $invoiceData['lines']['data'][0]['price']['id'],
            'currency' => $invoiceData['currency'],
            'amount' => $invoiceData['amount_due'],
            'invoice_url' => $invoiceData['hosted_invoice_url'],
            'status' => 1,
        ]);

        $invoice->save();
    }

}
