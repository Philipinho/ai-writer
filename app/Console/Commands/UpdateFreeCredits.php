<?php

namespace App\Console\Commands;

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
        $teams = Team::whereDoesntHave('subscriptions', function ($query) {
            $query->where('stripe_status', 'active');
        })->get();

        foreach ($teams as $team) {

            try {
                $teamCredits = $team->teamCredit;

                if ($teamCredits && $teamCredits->plan = 'Free' && $teamCredits->expiration_date->isPast()) {

                    $teamCredits->update([
                        'credits' => config('stripe.free_plan_credits'),
                        'original_plan_credits' => config('stripe.free_plan_credits'),
                        'start_date' => Carbon::now(),
                        'expiration_date' => Carbon::now()->addMonth(),
                    ]);
                }
            } catch (\Exception $e) {
                $errorMessage = "Error updating team credits for team ID: {$team->id}. Exception: {$e->getMessage()}";
                $this->error($errorMessage);
                Log::error($errorMessage);
            }
        }

    }
}
