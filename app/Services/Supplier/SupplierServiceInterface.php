<?php


namespace App\Services\Supplier;


interface SupplierServiceInterface
{

    public function findByName($name);

    public function getAllSupplier();

}
