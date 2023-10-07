<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PaymentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->HasPermission('payment.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Payment $payment): bool
    {
        return $admin->HasPermission('payment.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->HasPermission('payment.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin): bool
    {
        return $admin->HasPermission('payment.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin): bool
    {
        return $admin->HasPermission('payment.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(Admin $admin, Payment $payment): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(Admin $admin, Payment $payment): bool
    // {
    //     //
    // }
}
