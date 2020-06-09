<?php


namespace App\Services\Model;


use App\Models\Model;

interface ModelServiceInterface
{

//  create new model
    public function create(array $model): Model;


    public function update($id, $data): Model;


    public function delete($id): Model;

    public function getQtyItemByCond(string $condition, int $id, int $whlocationId);

    public function getQtyItemByTransfer(int $id, int $whlocationId);

    public function getQtyItemByModel(int $id);


}
