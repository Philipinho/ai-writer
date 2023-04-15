<?php

namespace App\Listeners;

use Illuminate\Support\Carbon;
use Laravel\Jetstream\Events\TeamCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddCreditsToTeamAccount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TeamCreated $event): void
    {
        $team = $event->team;

        $team->teamCredits()->firstOrCreate(
            ['team_id' => $team->id],
            [
                'plan' => 'Free',
                'credits' => config('stripe.free_plan_credits'),
                'original_plan_credits' => config('stripe.free_plan_credits'),
                'interval' => 'month',
                'start_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addMonth(),
            ]
        );

    }
}
