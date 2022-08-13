<?php

namespace App\Policies;

use App\Models\Space;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpacePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Space $space
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Space $space): \Illuminate\Auth\Access\Response|bool
    {
        return $user->id === $space->owner_id || $user->joinedSpaces->contains($space);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can generate an invite.
     *
     * @param User $user
     * @param Space $space
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function invite(User $user, Space $space): \Illuminate\Auth\Access\Response|bool
    {
        return $user->id === $space->owner_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Space $space
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Space $space): \Illuminate\Auth\Access\Response|bool
    {
        return $user->id === $space->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Space $space
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Space $space): \Illuminate\Auth\Access\Response|bool
    {
        return $user->id === $space->owner_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Space $space
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Space $space): \Illuminate\Auth\Access\Response|bool
    {
        return $user->id === $space->owner_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Space $space
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Space $space): \Illuminate\Auth\Access\Response|bool
    {
        return $user->id === $space->owner_id;
    }

    public function addPost(User $user, Space $space): \Illuminate\Auth\Access\Response|bool
    {
        return $user->id === $space->owner_id;
    }
}
