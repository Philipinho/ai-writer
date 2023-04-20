<?php

namespace App\Providers;

use App\Listeners\AddCreditsToTeamAccount;
use App\Listeners\Stripe\PaymentsListener;
use App\Listeners\Stripe\StripeCustomerUpdated;
use App\Listeners\Stripe\StripePaymentSucceeded;
use App\Listeners\Stripe\StripeSubscriptionCancelled;
use App\Listeners\Stripe\StripeSubscriptionCreated;
use App\Listeners\Stripe\StripeSubscriptionUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Laravel\Cashier\Events\WebhookReceived;
use Laravel\Jetstream\Events\TeamCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
       // WebhookReceived::class => [
         //   PaymentsListener::class,
       // ],
        TeamCreated::class => [
            AddCreditsToTeamAccount::class,
        ],
        'stripe-webhooks::invoice.payment_succeeded' => [
            StripePaymentSucceeded::class,
        ],
        'stripe-webhooks::customer.subscription.created' => [
            StripeSubscriptionCreated::class,
        ],
        'stripe-webhooks::customer.subscription.deleted' => [
            StripeSubscriptionCancelled::class
        ],
        'stripe-webhooks::customer.subscription.updated' => [
            StripeSubscriptionUpdated::class
        ],
        'stripe-webhooks::customer.updated' => [
            StripeCustomerUpdated::class
        ],

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
