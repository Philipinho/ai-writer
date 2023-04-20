<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BillingController extends Controller
{


    public function index(Request $request): \Inertia\Response
    {
        $plans = config('stripe.plans');

        $team = auth()->user()->currentTeam;

        $hasActiveSubscription = true; // TODO
        //if ($team->teamCredits) {
        //    $hasActiveSubscription = $team->subscribed('default');
      //  }

        return Inertia::render('Billing/Index', ['plans' => $plans,
            'credits' => $team->teamCredits,
            'subscribed' => $hasActiveSubscription,
            'usage_stats' => $team->teamCredits?->getStats(),
            ]);
    }

}
