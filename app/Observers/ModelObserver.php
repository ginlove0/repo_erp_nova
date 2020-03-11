<?php

namespace App\Observers;

use App\Models\Model;
use Illuminate\Support\Facades\Auth;

class ModelObserver
{
    //

    public function saving (Model $model)
    {
        $user = Auth::user();
        $model -> addedBy = $user -> email;
    }
}
