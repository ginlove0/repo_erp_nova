<?php

namespace App\Services\Supplier;


use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplierService implements SupplierServiceInterface
{
    public function findByName($id)
    {
        $supplier = Supplier::where('id', $id)->get();
        return $supplier;
        // TODO: Implement findByName() method.
    }

    public function getAllSupplier()
    {
        $datas = DB::select('SELECT name, id FROM supplier');

        return $datas;
        // TODO: Implement getAllSupplier() method.
    }
}
