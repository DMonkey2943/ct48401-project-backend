<?php

namespace App\Policies;

use App\Models\Deck;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeckPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Deck $deck): bool
    {
        return $user->id === $deck->userId || $deck->isSuperUser;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Deck $deck): bool
    {
        return $user->id === $deck->userId;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Deck $deck): bool
    {
        return $user->id === $deck->userId;
    }
}
