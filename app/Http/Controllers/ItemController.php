<?php

namespace App\Http\Controllers;

use App\Services\Item\ItemServiceInterface;
use Illuminate\Http\Request;

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
}
