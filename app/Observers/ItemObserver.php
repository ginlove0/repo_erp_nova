<?php

namespace App\Observers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemObserver
{

    public function saving(Item $item)
    {

        $user = Auth::user();
        $item->addedBy = $user->email;
    }
}
