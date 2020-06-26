<?php


namespace Ipsupply\WarehouseTransferTool\Http\Controllers;


use App\Models\Supplier;
use App\Services\Supplier\SupplierServiceInterface;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{

    public function show()
    {
        $datas = DB::select('SELECT name, id FROM supplier');

        return $datas;
    }

    public function addSupplierInManuallyAdd($supplierDetail)
    {
        if($supplierDetail)
        {
            $object = json_decode($supplierDetail);

            Log::info($object -> name, ['name']);
            Log::info($object -> contactType, ['contactType']);
            Log::info($object -> pricingLevel, ['pricingLevel']);

            Supplier::create([
                'name' => $object -> name,
                'pricingLevel' => $object -> pricingLevel,
                'contactType' => $object -> contactType
            ]);

            return $this -> findSupplierByName($object -> name);
        }

    }

    public function findSupplierByName($value)
    {
        $supplier = Supplier::where('name', $value)->first();
        return $supplier;
    }
}
