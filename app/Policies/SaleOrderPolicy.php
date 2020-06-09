<?php

namespace App\Policies;

use App\User;
use App\Models\SaleOrder;
use Illuminate\Auth\Access\HandlesAuthorization;

class SaleOrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any sale orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return $user->user_type === 'admin';
    }

    /**
     * Determine whether the user can view the sale order.
     *
     * @param  \App\User  $user
     * @param  \App\SaleOrder  $saleOrder
     * @return mixed
     */
    public function view(User $user, SaleOrder $saleOrder)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create sale orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the sale order.
     *
     * @param  \App\User  $user
     * @param  \App\SaleOrder  $saleOrder
     * @return mixed
     */
    public function update(User $user, SaleOrder $saleOrder)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can delete the sale order.
     *
     * @param  \App\User  $user
     * @param  \App\SaleOrder  $saleOrder
     * @return mixed
     */
    public function delete(User $user, SaleOrder $saleOrder)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can restore the sale order.
     *
     * @param  \App\User  $user
     * @param  \App\SaleOrder  $saleOrder
     * @return mixed
     */
    public function restore(User $user, SaleOrder $saleOrder)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can permanently delete the sale order.
     *
     * @param  \App\User  $user
     * @param  \App\SaleOrder  $saleOrder
     * @return mixed
     */
    public function forceDelete(User $user, SaleOrder $saleOrder)
    {
        //
        return true;
    }
}
