<?php

namespace App\Services\WhTransfer;

use App\Models\Item;
use App\Models\WhTransfer;
use App\Models\WhTransferModel;
use Illuminate\Support\Facades\Log;

class WhTransferService implements WhTransferServiceInterface
{

    public function findItemByWhTransfer(int $WhTransferId)
    {

        $items = Item::where('wh_transfer_id', $WhTransferId)->with('models','conditions', 'suppliers', 'whlocations')->get();

        Log::info($items);
        return $items;
        // TODO: Implement findItemByWhTransfer() method.
    }
}
