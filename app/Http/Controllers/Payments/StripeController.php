<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\BillingPortal\Session as BillingPortal;
use Stripe\Stripe;

class StripeController extends Controller
{

    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function checkout(Request $request): JsonResponse
    {
        $stripeId = $request->user()->currentTeam->stripe_id;

        $checkout = CheckoutSession::create([
            'line_items' => [[
                'price' => $request->input('price_id'),
                'quantity' => 1,
            ]],
            'customer' => $stripeId,
            'allow_promotion_codes' => 'true',
            'mode' => 'subscription',
            'currency' => 'usd',
            'success_url' => route('billing'),
            'cancel_url' => route('billing'),
        ]);

        return response()->json(['url' => $checkout->url]);
    }

    public function billingPortal(Request $request)
    {
        $stripeId = $request->user()->currentTeam->stripe_id;

        $portal = BillingPortal::create([
            'customer' => $stripeId,
            'return_url' => route('billing'),
        ]);

        return redirect($portal->url);
    }


}
