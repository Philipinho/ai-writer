<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Document $document): bool
    {
        return $user->currentTeam->id === $document->team_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // check if user has credit and its not expired
        return $user->ownsTeam($user->currentTeam) || $user->hasTeamRole($user->currentTeam, 'editor');
    }

    /**
     * Determine whether the user has valid credits and can generate new content.
     */
    public function generate(User $user)
    {
        $team = $user->currentTeam;
        $teamCredits = $team->teamCredits;
        // Check if the user's team has valid credits
        return $teamCredits && $teamCredits->credits > 0 && $teamCredits->expiration_date->isFuture();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Document $document): bool
    {
       // $teamHasActiveSubscription = $user->currentTeam->subscribed('default');

        return $user->ownsTeam($user->currentTeam) || $user->hasTeamRole($user->currentTeam, 'editor');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Document $document): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Document $document): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Document $document): bool
    {
        //
    }

}
