<?php

namespace App\Policies;

use App\Models\CollectionPoint;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CollectionPointPolice
{
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
    public function view(User $user, CollectionPoint $collectionPoint): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return (in_array($user->role, ['admin', 'manager'], true) || $user->email_verified_at !== null);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CollectionPoint $collectionPoint): bool
    {
        return (in_array($user->role, ['admin', 'manager'], true) || $user->id === $collectionPoint->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CollectionPoint $collectionPoint): bool
    {
        return (in_array($user->role, ['admin', 'manager'], true) || $user->id === $collectionPoint->user_id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CollectionPoint $collectionPoint): bool
    {
        return (in_array($user->role, ['admin', 'manager'], true));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CollectionPoint $collectionPoint): bool
    {
        return (in_array($user->role, ['admin', 'manager'], true) || $user->id === $collectionPoint->user_id);
    }
}
