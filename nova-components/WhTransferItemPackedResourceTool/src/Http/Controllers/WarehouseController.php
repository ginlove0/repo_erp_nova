<?php

namespace Ipsupply\WhTransferItemPackedResourceTool\Http\Controllers;

use App\Models\Item;
use App\Models\WhTransferModel;
use App\Services\WhTransfer\WhTransferServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Actions\Action;

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

        $item = Item::where('id', $id) -> first();


        if($item)
        {
            $item -> wh_transfer_id = null;
            $item -> save();

        }

        $getModels = WhTransferModel::where('whTransferId', $whtransferId) -> get();
        foreach ($getModels as $getModel)
        {
            if($getModel -> packed_qty > 0 && $getModel -> packed_qty <= $getModel -> qty)
            {
                $getModel -> packed_qty = $getModel -> packed_qty - 1;
                $getModel->save();
                return Action::message('Finished!');
            }

        }
    }
}
