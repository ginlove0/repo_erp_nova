<?php

namespace Ipsupply\SearchMultipleUsItem\Http\Controllers;


use App\Models\Item;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SearchMultipleUsItem extends Controller
{
    public function findUsItem($sn)
    {
        $item = Item::where('serialNumber', $sn)
            ->where('whlocationId', '>=', 2)
            ->with('models', 'conditions', 'whlocations', 'suppliers')
            ->get();
        return $item;

    }
    public function outstock($sn)
    {
        $item = Item::where('serialNumber', $sn)->with('models', 'conditions', 'whlocations', 'suppliers')->first();

        if($item)
        {
            $item -> stockStatus = false;
            $item -> save();
            return $item;
        }
    }

    public function instock($sn)
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
