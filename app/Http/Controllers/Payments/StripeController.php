<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\BillingPortal\Session as BillingPortal;
use Stripe\Stripe;
use Stripe\Customer as StripeCustomer;

class StripeController extends Controller
{

    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret_key'));
    }

    public function checkout(Request $request): JsonResponse
    {
        $stripeId = $this->createOrGetStripeCustomer($request->user()->currentTeam);

        $checkout = CheckoutSession::create([
            'line_items' => [[
                'price' => $request->input('price_id'),
                'quantity' => 1,
            ]],
            'customer' => $stripeId,
            'allow_promotion_codes' => true,
            'mode' => 'subscription',
            'currency' => 'usd',
            'success_url' => route('billing'),
            'cancel_url' => route('billing'),
        ]);

        return response()->json(['url' => $checkout->url]);
    }

    public function billingPortal(Request $request)
    {
        // create stripe customer first if not exist
        $stripeId = $request->user()->currentTeam->stripe_id;

        $portal = BillingPortal::create([
            'customer' => $stripeId,
            'return_url' => route('billing'),
        ]);

        return redirect($portal->url);
    }

    function createOrGetStripeCustomer(Team $team): string
    {
        $stripeId = $team->stripe_id;

        if ($stripeId) {
            return $stripeId;
        }

        $customer = StripeCustomer::create([
            'email' => $team->owner->email,
            'name' => $team->name,
        ]);

        $team->stripe_id = $customer->id;
        $team->save();

        return $customer->id;
    }

}
