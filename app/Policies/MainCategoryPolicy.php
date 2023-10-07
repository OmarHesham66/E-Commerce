<?php

namespace App\Policies;

use App\Models\SuperCategory;
use App\Models\admin;
use Illuminate\Auth\Access\Response;

class MainCategoryPolicy
{
    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->HasPermission('main_category.view');
    }

    /**
     * Determine whether the admin can view the model.
     */
    // public function view(Admin $admin, SuperCategory $superCategory): bool
    // {
    //     //
    // }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->HasPermission('main_category.create');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin): bool
    {
        return $admin->HasPermission('main_category.edit');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function destroy(Admin $admin): bool
    {
        return $admin->HasPermission('main_category.delete');
    }

    /**
     * Determine whether the admin can restore the model.
     */
    // public function restore(Admin $admin, SuperCategory $superCategory): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the admin can permanently delete the model.
    //  */
    // public function forceDelete(Admin $admin, SuperCategory $superCategory): bool
    // {
    //     //
    // }
}
