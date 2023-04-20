<?php

namespace App\Listeners;

use App\Models\Plan;
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

        $freePlan = Plan::where('free', true)->first();

        $team->teamCredits()->firstOrCreate(
            ['team_id' => $team->id],
            [
                'plan_id' => $freePlan->id,
                'credits' => config('stripe.free_plan_credits'),
                'credits_used' => 0,
                'original_plan_credits' => $freePlan->credits,
                'interval' => 'month',
                'start_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addMonth(),
            ]
        );

    }
}
