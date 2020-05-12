<?php
namespace Ipsupply\ItemTransferResourceTool\Http\Controllers;

use App\Models\Model;
use App\Models\WhTransferModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemTransferResourceToolController extends Controller
{
    public function addProduct($whtransferId, $product)
    {
        $object = json_decode($product);
        Log::info($object -> conditionId, ['conditionId']);
        WhTransferModel::create([
            'whTransferId' => $whtransferId,
            'modelId' => $object -> modelId,
            'conditionId' => $object -> conditionId,
            'qty' => $object -> qty,
            'note' => $object->note
        ]);


    }

    public function findAllModel()
    {
        $datas = DB::select('SELECT name, id FROM `model`');

        return $datas;
    }


    public function fetchModelWhTransfer($whtransferId)
    {
        $datas = WhTransferModel::where('whTransferId', $whtransferId)->with('models', 'conditions')->get();


        return $datas;
    }

    public function deleteItemInWhTransfer($id)
    {
        $deleteItem = WhTransferModel::where('id', $id)->first();
        if($deleteItem)
        {
            $deleteItem -> delete();
        }
    }

    public function addModel($modelDetail)
    {

        $object = json_decode($modelDetail);
        Log::info($object -> name, ['name']);
        Log::info($object -> manufactorId);
        Log::info($object -> categoryId);

        Model::create([
            'name' => $object -> name,
            'manufactorId' => $object -> manufactorId,
            'categoryId' => $object -> categoryId,
            'shortDescription' => $object -> shortDescription,
            'longDescription' => $object -> longDescription
        ]);
    }

    public function findAllManufactor()
    {
        $datas = DB::select('SELECT name, id FROM `manufactor`');

        return $datas;
    }

    public function findAllCategory()
    {
        $datas = DB::select('SELECT name, id FROM `category`');

        return $datas;
    }
}
