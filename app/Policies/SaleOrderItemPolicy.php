<?php

namespace App\Policies;

use App\User;
use App\Models\SaleOrderItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class SaleOrderItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any sale order items.
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
     * Determine whether the user can view the sale order item.
     *
     * @param  \App\User  $user
     * @param  \App\SaleOrderItem  $saleOrderItem
     * @return mixed
     */
    public function view(User $user, SaleOrderItem $saleOrderItem)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create sale order items.
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
     * Determine whether the user can update the sale order item.
     *
     * @param  \App\User  $user
     * @param  \App\SaleOrderItem  $saleOrderItem
     * @return mixed
     */
    public function update(User $user, SaleOrderItem $saleOrderItem)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can delete the sale order item.
     *
     * @param  \App\User  $user
     * @param  \App\SaleOrderItem  $saleOrderItem
     * @return mixed
     */
    public function delete(User $user, SaleOrderItem $saleOrderItem)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can restore the sale order item.
     *
     * @param  \App\User  $user
     * @param  \App\SaleOrderItem  $saleOrderItem
     * @return mixed
     */
    public function restore(User $user, SaleOrderItem $saleOrderItem)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can permanently delete the sale order item.
     *
     * @param  \App\User  $user
     * @param  \App\SaleOrderItem  $saleOrderItem
     * @return mixed
     */
    public function forceDelete(User $user, SaleOrderItem $saleOrderItem)
    {
        //
        return true;
    }
}
