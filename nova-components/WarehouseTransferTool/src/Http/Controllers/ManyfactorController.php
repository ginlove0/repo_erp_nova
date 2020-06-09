<?php


namespace Ipsupply\WarehouseTransferTool\Http\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ManyfactorController extends Controller
{
    public function show()
    {
        $datas = DB::select('SELECT name, id FROM manufactor');

        return $datas;
    }
}
