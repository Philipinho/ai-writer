<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamCredit extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getStats()
    {
        $planCredits = $this->original_plan_credits;

        $creditAllocation = $this->credits + $this->payg_credits + $this->bonus_credits;

        $creditsUsed = $this->credits_used;
        $creditsLeft = $creditAllocation - $creditsUsed;

        $percentUsed = $creditAllocation > 0 ? ($creditsUsed / $creditAllocation) * 100 : 0;
        $percentLeft = $creditAllocation > 0 ? ($creditsLeft / $creditAllocation) * 100 : 0;

        return [
            'plan' => $this->plan,
            'plan_credits' => number_format($planCredits),
            'total_credits' => number_format($creditAllocation),
            'credits_left' => number_format($creditsLeft),
            'credits_used' => $creditsUsed,
            'percent_used' => $percentUsed,
            'percent_left' => $percentLeft,
            'start_date' => $this->start_date,
            'expiration_date' => $this->expiration_date
        ];
    }

    /**
     * Deducts the specified amount of credits from the team's credits.
     *
     * @param int $consumedCredits
     * @return void
     */
    public function updateCreditUsage(int $consumedCredits): void
    {
        $this->credits_used += $consumedCredits;
        $this->save();
    }

}
