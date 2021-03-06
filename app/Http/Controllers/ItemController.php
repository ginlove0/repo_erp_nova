<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\Item\ItemServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    //

    private $itemService;
    public function __construct(ItemServiceInterface $itemService)
    {
       $this -> itemService = $itemService;
    }

    public function findBySN($sn)
    {
        return $this -> itemService -> findBySN($sn);
    }

    public function findBySNwithOther($sn)
    {
        return $this->itemService->findBySNwithOther($sn);
    }

    public function findItemDetail($modelId, $conditionId, $whlocationId)
    {
        $item = Item::where([
            ['modelId', $modelId],
            ['conditionId', $conditionId],
            ['whlocationId', $whlocationId],
            ['stockStatus', true]
            ])->with('models', 'suppliers', 'conditions', 'whlocations')->get();
        return $item;
    }

}
