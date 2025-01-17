<?php

namespace App\Policies;

use App\Models\Cake;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CakePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cake $cake): bool
    {
        return false;
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
    public function update(User $user, Cake $cake): bool
    {
        return $cake->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cake $cake): bool
    {
        return $this->update($user, $cake);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cake $cake): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cake $cake): bool
    {
        return false;
    }
}
