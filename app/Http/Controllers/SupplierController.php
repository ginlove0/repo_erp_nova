<?php

namespace App\Http\Controllers;


use App\Services\Supplier\SupplierServiceInterface;

class SupplierController extends Controller
{
    private $supplierService;

    public function __construct(SupplierServiceInterface $supplierService)
    {
        return $this -> supplierService = $supplierService;
    }

    public function show()
    {
        return $this -> supplierService -> getAllSupplier();
    }

    public function findByName($name)
    {
        return $this -> supplierService -> findByName($name);
    }
}
