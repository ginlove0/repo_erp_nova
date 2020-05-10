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

        Log::info($object -> modelId);
        Log::info($object -> qty);
        Log::info($object -> conditionId);
        Log::info($object->note);

        Log::info($whtransferId);
        WhTransferModel::create([
            'whTransferId' => $whtransferId,
            'modelId' => $object -> modelId,
            'conditionId' => $object -> conditionId,
            'qty' => $object -> qty,
            'note' => $object->note
        ]);


        return 'hello';
    }

    public function findAllModel()
    {
        $datas = DB::select('SELECT name, id FROM model');

        return $datas;
    }

    public function findAllCondition()
    {
        $datas = DB::select('SELECT name, id FROM `condition`');

        return $datas;
    }
}
