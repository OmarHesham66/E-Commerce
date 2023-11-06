<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->HasPermission('role.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Role $role): bool
    {
        // dd($admin->role()->where('roles.id', $role->id)->exists());
        return $admin->HasPermission('role.view') && $admin->HasRole($role);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->HasPermission('role.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin): bool
    {
        return $admin->HasPermission('role.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin): bool
    {
        return $admin->HasPermission('role.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(Admin $admin, Permission $permission): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(Admin $admin, Permission $permission): bool
    // {
    //     //
    // }
}
