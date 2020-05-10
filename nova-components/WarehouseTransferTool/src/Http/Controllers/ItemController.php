<?php

namespace Ipsupply\WarehouseTransferTool\Http\Controllers;

use App\Models\Item;
use App\Services\Item\ItemServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    private $itemService;

    public function __construct(ItemServiceInterface $itemService){
        $this -> itemService = $itemService;
    }

    public function index($sn, $conditionId, $whlocationId, $supplierName)
    {

        Log::info($sn);
        Log::info($conditionId);
        Log::info($whlocationId);
        Log::info($supplierName);

    }

    public function addItemNoCondition($sn, $whlocationId, $supplierName)
    {
        Log::info($sn);
        Log::info($whlocationId);
        Log::info($supplierName);
    }
}
