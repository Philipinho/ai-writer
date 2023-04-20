<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BillingController extends Controller
{

    public function index(Request $request): \Inertia\Response
    {
        $plans = config('stripe.plans');

        $team = auth()->user()->currentTeam;
        $subscription = $team->subscription;

        $hasActiveSubscription = false;
        if ($subscription && $subscription->stripe_status === 'active') {
            $hasActiveSubscription = true;
        }

        return Inertia::render('Billing/Index', ['plans' => $plans,
            'credits' => $team->teamCredits,
            'subscribed' => $hasActiveSubscription,
            'usage_stats' => $team->teamCredits?->getStats(),
            'stripe_status' => $subscription?->stripe_status
        ]);
    }

}
