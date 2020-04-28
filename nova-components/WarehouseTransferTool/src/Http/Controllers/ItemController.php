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

    public function index($id, $note, $whlocation)
    {

        Log::info($id);
        Log::info($note);
        Log::info($whlocation);
        $item = Item::where('serialNumber', $id)->first();
        if($item){
            $item -> note = $item -> note . '#' . $note;
            $item -> whlocationId = $whlocation;
            $item -> save();
        }

    }
}
