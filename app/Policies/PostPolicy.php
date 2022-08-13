<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Post $post): bool
    {
        return $user->id === $post->space->owner_id || $user->joinedSpaces->contains($post->space);
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->space->owner_id;
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->space->owner_id;
    }

    public function restore(User $user, Post $post): bool
    {
        return $user->id === $post->space->owner_id;
    }

    public function forceDelete(User $user, Post $post): bool
    {
        return $user->id === $post->space->owner_id;
    }
}