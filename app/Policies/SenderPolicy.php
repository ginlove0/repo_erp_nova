<?php

namespace App\Policies;

use App\User;
use App\Models\Sender;
use Illuminate\Auth\Access\HandlesAuthorization;

class SenderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any senders.
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
     * Determine whether the user can view the sender.
     *
     * @param  \App\User  $user
     * @param  \App\Sender  $sender
     * @return mixed
     */
    public function view(User $user, Sender $sender)
    {
        //
        return false;
    }

    /**
     * Determine whether the user can create senders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return false;
    }

    /**
     * Determine whether the user can update the sender.
     *
     * @param  \App\User  $user
     * @param  \App\Sender  $sender
     * @return mixed
     */
    public function update(User $user, Sender $sender)
    {
        //
        return false;
    }

    /**
     * Determine whether the user can delete the sender.
     *
     * @param  \App\User  $user
     * @param  \App\Sender  $sender
     * @return mixed
     */
    public function delete(User $user, Sender $sender)
    {
        //
        return false;
    }

    /**
     * Determine whether the user can restore the sender.
     *
     * @param  \App\User  $user
     * @param  \App\Sender  $sender
     * @return mixed
     */
    public function restore(User $user, Sender $sender)
    {
        //
        return false;
    }

    /**
     * Determine whether the user can permanently delete the sender.
     *
     * @param  \App\User  $user
     * @param  \App\Sender  $sender
     * @return mixed
     */
    public function forceDelete(User $user, Sender $sender)
    {
        //
        return false;
    }
}
