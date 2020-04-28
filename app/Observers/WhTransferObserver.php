<?php

namespace App\Observers;

use App\Models\WhTransfer;
use Illuminate\Support\Facades\Auth;

class WhTransferObserver
{
    //

    public function saving(WhTransfer $transfer)
    {

        $user = Auth::user();
        $transfer->createdBy = $user->email;
    }
}
