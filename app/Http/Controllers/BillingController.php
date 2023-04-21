<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BillingController extends Controller
{

    public function index(Request $request): \Inertia\Response
    {
        $plans = Plan::where('free', false)->where('status', 1)->get()->map(function ($plan) {
            $plan->features = json_decode($plan->features, true);
            return $plan;
        });

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
