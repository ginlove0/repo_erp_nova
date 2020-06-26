<?php

namespace Ipsupply\WarehouseTransferTool\Http\Controllers;

use App\Models\Item;
use App\Models\Model;
use App\Models\Supplier;
use App\Services\Item\ItemServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    private $itemService;

    public function __construct(ItemServiceInterface $itemService){
        $this -> itemService = $itemService;
    }

    public function addItemToStock($product)
    {
        $object = json_decode($product);
        Log::info($object -> serialNumber, ['serialNumber']);
        Log::info($object -> conditionId, ['conditionId']);
        Log::info($object -> modelId, ['modelId']);
        Log::info($object -> supplierId, ['supplierId']);

        $user = Auth::user();
        $addBy = $user -> email;

        $supplier = Supplier::where('name', $object -> supplierId) -> first();

        Item::updateOrCreate([
            'serialNumber' => $object -> serialNumber],
            [
            'modelId' => $object-> modelId,
            'conditionId' => $object -> conditionId,
            'whlocationId' => $object -> whlocationId,
            'supplierId' => $object -> supplierId,
            'note' => $object -> note,
            'stockStatus' => true,
                'location' => $object -> location,
            'addedBy' => $addBy,

        ]);
    }
}
