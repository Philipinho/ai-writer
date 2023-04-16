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

        $hasActiveSubscription = false;
        if ($team->teamCredits) {
            $hasActiveSubscription = $team->subscribed('default');
        }

        return Inertia::render('Billing/Index', ['plans' => $plans,
            'credits' => $team->teamCredits,
            'subscribed' => $hasActiveSubscription,
            'usage_stats' => $team->teamCredits?->getStats(),
            ]);
    }

    public function checkout(Request $request): JsonResponse
    {
        $checkout = $request->user()->currentTeam
            ->newSubscription('default', $request->input('price_id'))
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('billing'),
                'cancel_url' => route('billing')
            ]);

        return response()->json(['url' => $checkout->url]);
    }

    public function billingPortal(Request $request)
    {
        return $request->user()->currentTeam->redirectToBillingPortal(route('billing'));
    }

}
