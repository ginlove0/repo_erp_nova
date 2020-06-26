<?php


declare(strict_types=1);

namespace App\Services\Model;


use App\Models\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ModelService implements ModelServiceInterface
{


//  create new model
    public function create(array $model): Model
    {
        return Model::create($model);
    }

    public function update($id, $data): Model
    {
        $model = Model::findOrFail($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function delete($id): Model
    {
        $model = Model::findOrFail($id);
        $model->delete();
        $model->save();
        return $model;
    }

    public function getQtyItemByCond(string $condition, int $id, int $whlocationId)
    {

//        $querySydney = "and item.whlocationId = (select id from whlocation where name = '$whlocation' limit 1)";
//
//        $queryCondition = "and item.conditionId = (select id from condition where name = '$condition' limit 1)";


        $data = DB::select("
            select sum(quantity) as QTY, item.modelId as ModelId, item.conditionId as ConditionId, item.whlocationId as WhLocationId
            from item
            where item.conditionId = (select id from `condition` where name = ? limit 1)
            and item.modelId = (select id from `model` WHERE id = ? limit 1)
            and item.whlocationId = (select id from `whlocation` WHERE id =? limit 1)
            and item.stockStatus = true
        ", [
            $condition,
            $id,
            $whlocationId,
        ]);

        return $data;
        // TODO: Implement getQtyItemByCond() method.
    }

    public function getQtyItemByTransfer(int $id, int $whlocationId)
    {
        $data = DB::select("
            select sum(quantity) as QTY
            from item
            where item.modelId = (select id from `model` WHERE id = ? limit 1)
            and item.whlocationId = (select id from `whlocation` WHERE id =? limit 1)
            and item.stockStatus = true
        ", [
            $id,
            $whlocationId,
        ]);

        return $data;

        // TODO: Implement getQtyItemByTransfer() method.
    }

    public function getQtyItemByModel(int $id)
    {
        $data = DB::select("
            select sum(quantity) as QTY, modelId as Model
            from item
            where item.modelId = $id
            and item.stockStatus = true
            group by created_at
        ");



        return $data;

        // TODO: Implement getQtyItemByModel() method.
    }
}
