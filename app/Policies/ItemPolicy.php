<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create() {
        return false;
    }

    public function delete(){
        return false;
    }

    public function view() {
        return true;
    }

    public function update() {
        return true;
    }

    public function forceDelete()
    {
        return true;
    }

    public function viewAny(User $user)
    {
        //
        return $user->user_type === 'admin';
    }
}
