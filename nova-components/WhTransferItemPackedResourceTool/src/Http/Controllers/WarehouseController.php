<?php

namespace Ipsupply\WhTransferItemPackedResourceTool\Http\Controllers;

use App\Models\Item;
use App\Services\WhTransfer\WhTransferServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class WarehouseController extends Controller
{
    private $whTransfer;

    public function __construct(WhTransferServiceInterface $whTransferService)
    {
        $this->whTransfer  = $whTransferService;
    }

    public function show($whTransferId)
    {
        Log::info($whTransferId);
        return $this->whTransfer->findItemByWhTransfer($whTransferId);
    }

    public function deleteItem($id, $whtransferId)
    {
        Log::info($id);
        Log::info($whtransferId);

        $item = Item::where('id', $id) -> first();

        if($item)
        {
//            if($item -> whlocationId === 3)
//            {
//                $newLocationId = 1;
//            }
//            else {
//                $newLocationId = 2;
//            }

            $item -> wh_transfer_id = null;
//            $item -> whlocationId = $newLocationId;
            $item -> save();

        }
    }
}
