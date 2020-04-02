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
        return true;
    }

    public function delete(){
        return true;
    }

    public function view() {
        return true;
    }

    public function update() {
        return true;
    }

}
