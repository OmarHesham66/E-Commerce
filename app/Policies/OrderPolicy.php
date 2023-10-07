<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Order;
use App\Models\User;
use App\Models\UserOrder;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->HasPermission('order.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, UserOrder $order): bool
    {
        return $admin->HasPermission('order.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->HasPermission('order.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin): bool
    {
        return $admin->HasPermission('order.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin): bool
    {
        return $admin->HasPermission('order.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(Admin $admin, UserOrder $order): bool
    // {
    //     return $admin->HasPermission('order.delete');

    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(Admin $admin, UserOrder $order): bool
    // {
    //     //
    // }
}
