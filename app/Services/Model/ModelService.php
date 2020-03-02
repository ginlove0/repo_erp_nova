<?php


declare(strict_types=1);

namespace App\Services\Model;


use App\Models\Model;
use Illuminate\Support\Facades\DB;

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
            select count(*) as QTY
            from item
            where item.conditionId = (select id from `condition` where name = ? limit 1)
            and item.modelId = (select id from `model` WHERE id = ? limit 1)
            and item.whlocationId = (select id from `whlocation` WHERE id =? limit 1)
        ", [
            $condition,
            $id,
            $whlocationId,
        ]);

        return $data;
        // TODO: Implement getQtyItemByCond() method.
    }
}
