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

        return Inertia::render('Billing/Index', ['plans' => $plans]);
    }

    public function checkout(Request $request): JsonResponse
    {

        $checkout = $request->user()->currentTeam
            ->newSubscription($request->input('plan'), $request->input('price_id'))
            ->checkout([
                'success_url' => route('dashboard'),
                'cancel_url' => route('billing')
            ]);

        return response()->json(['url' => $checkout->url]);
    }

    public function subscription(Request $request)
    {
        return $request->user()->currentTeam->newSubScription(['prod_NfclpEMdKUIdLO', 'price_1MuHWOARjxFKY8qXD2mRcv5n'])
            ->create($request->paymentMethodId);

        /*
        $request->validate([
          //  'plan' => 'required|in:basic,standard',
       // ]);

        $team = $request->user()->currentTeam;
        $plan = config('stripe.plans')[$request->plan];

        $checkout = $request->user()->currentTeam->newSubscription($request->input('plan_name'),
            $request->input('plan_id'))
            ->checkout([
                'success_url' => route('dashboard'),
                'cancel_url' => route('subscription')
            ]);

        return Inertia::render('Subscription/Index', [
            'stripeKey' => config('cashier.key'),
            'sessionId' => $checkout->id
        ]);
        */
    }


    public function billingPortal(Request $request)
    {
        return $request->user()->currentTeam->redirectToBillingPortal(route('dashboard'));
    }

}
