<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModelPolicy
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
        return false;
    }

    public function view() {
        return true;
    }

    public function update() {
        return true;
    }

    public function forceDetele() {
        return false;
    }
}
