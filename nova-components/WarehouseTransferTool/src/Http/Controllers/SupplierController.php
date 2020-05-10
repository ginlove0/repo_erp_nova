<?php


namespace Ipsupply\WarehouseTransferTool\Http\Controllers;


use App\Services\Supplier\SupplierServiceInterface;
use Illuminate\Routing\Controller;

class SupplierController extends Controller
{

    private $supplierService;

    public function __construct(SupplierServiceInterface $supplierService)
    {
        return $this->supplierService = $supplierService;
    }

    public function show()
    {
        return $this->supplierService->getAllSupplier();
    }

    public function findByName($id)
    {
        return $this->supplierService->findByName($id);
    }
}
