<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemUSPolicy
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
        return false;
    }
}
