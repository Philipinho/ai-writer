<?php

namespace App\Console\Commands;

use App\Models\Plan;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateFreeCredits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-free-credits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update credits for teams on the free plan.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $teams = Team::whereDoesntHave('subscription', function ($query) {
            $query->where('status', 1);
        })->with('teamCredits')->get();

        foreach ($teams as $team) {

            try {
                $teamCredits = $team->teamCredits;
                $freePlan = Plan::where('free', true)->first();

                if ($teamCredits && $teamCredits->plan_id == $freePlan->id &&
                    Carbon::parse($teamCredits->expiration_date)->isPast()) {

                    $teamCredits->update([
                        'credits' => config('stripe.free_plan_credits'),
                        'credits_used' => 0,
                        'original_plan_credits' => config('stripe.free_plan_credits'),
                        'start_date' => Carbon::now(),
                        'expiration_date' => Carbon::now()->addMonth(),
                    ]);
                    $this->info("Updated Team #{$team->id}. Team Name: {$team->name}");
                }
            } catch (\Exception $e) {
                $errorMessage = "Error updating team credits for team ID: {$team->id}. Exception: {$e->getMessage()}";
                $this->error($errorMessage);
                Log::error($errorMessage);
            }
        }

    }
}
