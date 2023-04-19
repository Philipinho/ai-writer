<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        return $user->belongsToTeam($team);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can add team members.
     */
    public function addTeamMember(User $user, Team $team): bool
    {
        /*
        $planName = $team->currentPlan();
        $maxSeats = Config::get("plans.{$planName}.seats");

        // Retrieve the current number of team members
        $currentTeamMembersCount = $team->users->count();

        // Check if the current number of team members is less than the maximum allowed seats
        if ($currentTeamMembersCount < $maxSeats) {
            return $user->ownsTeam($team);
        } else {
            return false;
        }
        */

        return true;
    }

    /**
     * Determine whether the user can update team member permissions.
     */
    public function updateTeamMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can remove team members.
     */
    public function removeTeamMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    public function creditCheck(User $user, Team $team): bool
    {
        $teamCredits = $team->teamCredits;

        if (!$teamCredits) {
            return false;
        }

        $creditsAllocated = $teamCredits->credits; // $teamCredits->payg_credits + $teamCredits->bonus_credits;

        if($teamCredits->credits_used >= $creditsAllocated){
            return false;
        }

        return $teamCredits->expiration_date > now();
    }

}
