<?php

namespace Ipsupplt\SearchMultipleItems\Http\Controllers;


use App\Models\Item;
use App\Services\Item\ItemServiceInterface;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class SearchMultipleController extends Controller
{
    private $itemService;

    public function __construct(ItemServiceInterface $itemService){
        $this -> itemService = $itemService;
    }

    public function findBySNwithOther($sn)
    {
        return $this->itemService->findBySNwithOther($sn);
    }

    public function outStockSn($sn)
    {
        $item = Item::where('serialNumber', $sn)->with('models', 'conditions', 'whlocations', 'suppliers')->first();

        if($item)
        {
            $item -> stockStatus = false;
            $item -> save();
            return $item;
        }
    }

    public function inStockSn($sn)
    {
        $item = Item::where('serialNumber', $sn)->with('models', 'conditions', 'whlocations', 'suppliers')->first();

        if($item)
        {
            $item -> stockStatus = true;
            $item -> save();
            return $item;
        }
    }
}
