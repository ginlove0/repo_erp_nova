<?php


namespace Ipsupply\WarehouseTransferTool\Http\Controllers;


use App\Models\Model;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ModelController extends Controller
{
    public function show()
    {
        $datas = DB::select('SELECT name, id FROM model');

        return $datas;
    }

    public function addModelInManuallyAdd($modelDetail)
    {
        if($modelDetail){
            $object = json_decode($modelDetail);
            Log::info($modelDetail, ['object']);
            Model::create([
                'name' => $object -> name,
                'manufactorId' => $object -> manufactorId,
                'categoryId' => $object -> categoryId,
                'shortDescription' => $object -> shortDescription,
                'longDescription' => $object -> longDescription
            ]);

            return $this ->findModelByName($object -> name);
        }
    }

    public function findModelByName($modelName)
    {
        $model = Model::where('name', $modelName)->first();
        return $model;
    }
}
