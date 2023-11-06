<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RoleUserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(Admin $admin): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  */
    // public function view(Admin $admin, RoleUser $roleUser): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->HasPermission('role.select');
    }

    /**
     * Determine whether the user can update the model.
     */
    // public function update(Admin $admin, RoleUser $roleUser): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin): bool
    {
        return $admin->HasPermission('role.unset');
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(Admin $admin, RoleUser $roleUser): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(Admin $admin, RoleUser $roleUser): bool
    // {
    //     //
    // }
}
