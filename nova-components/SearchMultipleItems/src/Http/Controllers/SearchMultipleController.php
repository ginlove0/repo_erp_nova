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

    public function findBySNwithOther($product)
    {
        $object = json_decode($product);
//        Log::info($object -> serialNumber);
//        return $this->itemService->findBySNwithOther($sn);
        $item = Item::where('serialNumber', $object->serialNumber)->with('models', 'conditions', 'whlocations', 'suppliers')->get();
        return $item;
    }

    public function outStockSn($product)
    {

        $object = json_decode($product);
        $item = Item::where('serialNumber', $object->serialNumber)->first();

        if($item){
            if($object -> note && $object->conditionId)
            {
                $item -> stockStatus = false;
                $item -> note = $object -> note . '. ' .$item -> note;
                $item -> conditionId = $object -> conditionId;
                $item -> save();
            }else if ($object -> note && !$object -> conditionId) {
                $item -> stockStatus = false;
                $item -> note = $object -> note . '. ' .$item -> note;
                $item -> save();
            }else if ($object -> conditionId && !$object -> note){
                $item -> stockStatus = false;
                $item -> conditionId = $object -> conditionId;
                $item -> save();
            }else {
                $item -> stockStatus = false;
                $item -> save();
            }

        }
        $newitem = Item::where('serialNumber', $object->serialNumber)->with('models', 'conditions', 'whlocations', 'suppliers')->first();
        return $newitem;
    }

    public function inStockSn($product)
    {
        $object = json_decode($product);
        $item = Item::where('serialNumber', $object->serialNumber)->first();

        if($item){
            if($object -> note && $object->conditionId)
            {
                $item -> stockStatus = true;
                $item -> note = $object -> note . '. ' .$item -> note;
                $item -> conditionId = $object -> conditionId;
                $item -> save();
            }else if ($object -> note && !$object -> conditionId) {
                $item -> stockStatus = true;
                $item -> note = $object -> note . '. ' .$item -> note;
                $item -> save();
            }else if ($object -> conditionId && !$object -> note){
                $item -> stockStatus = true;
                $item -> conditionId = $object -> conditionId;
                $item -> save();
            }else {
                $item -> stockStatus = true;
                $item -> save();
            }

        }
        $newitem = Item::where('serialNumber', $object->serialNumber)->with('models', 'conditions', 'whlocations', 'suppliers')->first();
        return $newitem;
    }
}
