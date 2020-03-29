<?php


namespace App\Services\Item;


use App\Models\Item;

interface ItemServiceInterface
{

    public function findBySN(string $sn): Item;

    public function createWithNoSN(int $quantity, array $item): array;

    public function createOrUpdate(string $serialNumber, array $item): Item;

    public function create(array $item): Item;

    public function delete(int $id): Item;

    public function update(int $id, array $mass_data): Item;

    public function createAndAddSupplierAndCondidiont(array $items, int $supplierId, int $whlocationId): Item;

    public function toOutOfStock(int $id): Item;

    public function toInStock(int $id): Item;


}
