<?php


namespace App\Services\Item;


use App\Models\Item;
use App\Services\Condition\ConditionServiceInterface;
use App\Util\MutationRequest;

class ItemService implements ItemServiceInterface
{

    private $conditionService;
    public function __construct(ConditionServiceInterface $conditionService)
    {
        $this->conditionService = $conditionService;
    }

    public function createWithNoSN(int $quantity, array $item): array
    {
        $result = [];
        for($i = 0; $i < $quantity; $i++) {
            $newItem = $this->create($item);
           array_push( $result,$newItem);
        };

        return $result;
    }

    public function create(array $item): Item
    {
        return Item::create($item);
    }


    public function delete(int $id): Item
    {
        $data = Item::findOrFail($id);
        $data->delete();
        return $data;
    }

    public function update(int $id, array $mass_data): Item
    {
        $data = Item::findOrFail($id);
        $data->fill($mass_data);
        $data->save();
        return $data;
    }


    public function createAndAddSupplierAndCondidiont(array $items, int $supplierId, int $whlocationId): Item
    {
        $default_condition = "USEDB";

        $conditionId = $this->conditionService->findByName($default_condition)->id;

        $fields = array_merge($items, [
            "supplierId" => $supplierId,
            "whlocationId" => $whlocationId,
            "conditionId" => $conditionId
        ]);

        $serialNumber = $items['serialNumber'];
        unset($items['serialNumber']);

        return $this->createOrUpdate($serialNumber, $fields);
    }

    public function createOrUpdate(string $serialNumber, array $item): Item
    {
        return Item::updateOrCreate(['serialNumber' => $serialNumber],$item);

    }

    public function findBySN(string $sn): Item
    {
        return Item::where("serialNumber" , $sn)->firstOrFail();
    }



    public function toOutOfStock(int $id): Item
    {
        $item = Item::findOrFail($id);
        $item->update(["stockStatus" => false]);
        $item->save();
        return $item;
    }

    public function toInStock(int $id): Item
    {
        $item = Item::findOrFail($id);

        $item->update(["stockStatus" => true]);
        $item->save();

        return $item;
    }
}