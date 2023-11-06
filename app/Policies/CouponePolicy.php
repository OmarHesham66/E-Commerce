<?php

namespace App\Policies;

use App\Models\Coupone;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class CouponePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->HasPermission('coupone.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    // public function view(Admin $admin, Coupone $coupone): bool
    // {
    //     $admin->HasPermission('coupone.create');

    // }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->HasPermission('coupone.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    // public function update(Admin $admin, Coupone $coupone): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Coupone $coupone): bool
    {
        return $admin->HasPermission('coupone.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(Admin $admin, Coupone $coupone): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(Admin $admin, Coupone $coupone): bool
    // {
    //     //
    // }
}
