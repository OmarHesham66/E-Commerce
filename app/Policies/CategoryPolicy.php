<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use App\Models\category;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->HasPermission('category.view');
    }

    /**
     * Determine whether the admin can view the model.
     */
    // public function view(Admin $admin, category $category): bool
    // {
    //     return $admin->HasPermission('category.view');
    // }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->HasPermission('category.create');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin): bool
    {
        return $admin->HasPermission('category.edit');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin): bool
    {
        return $admin->HasPermission('category.delete');
    }

    /**
     * Determine whether the admin can restore the model.
     */
    // public function restore(User $user, category $category): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, category $category): bool
    // {
    //     //
    // }
}
