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

    public function getCreditStats()
    {
        $totalCredits = $this->original_plan_credits;// + $this->free_credits;
        $creditsLeft = $this->credits;
        $creditsUsed = $totalCredits - $creditsLeft;

        // Calculate the percentage values
        if ($totalCredits > 0) {
            $percentUsed = round(($creditsUsed / $totalCredits) * 100);
            $percentLeft = round(($creditsLeft / $totalCredits) * 100);
        } else {
            // When there are no total credits, set percentages to zero
            $percentUsed = 0;
            $percentLeft = 0;
        }

        return [
            'plan_credits' => number_format($totalCredits),
            'credits_left' => number_format($creditsLeft),
            'credits_used' => number_format($creditsUsed),
            'percent_used' => $percentUsed,
            'percent_left' => $percentLeft,
        ];
    }

    /**
     * Deducts the specified amount of credits from the team's credits.
     *
     * @param int $creditsToDeduct
     * @return bool
     */
    public function deductCredits(int $creditsToDeduct): bool
    {
        if ($creditsToDeduct < 0) {
            return false;
        }

        if ($this->credits >= $creditsToDeduct) {
            $this->credits -= $creditsToDeduct;
            $this->save();

            return true;
        }

        return false;
    }

}
