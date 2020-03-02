<?php
namespace Ipsupply\CheckoutItemResourceTool\Http\Controllers;

use App\Services\SaleOrder\SaleOrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SaleOrderController extends Controller
{

         private $saleOrderService;
        public function __construct(SaleOrderServiceInterface $saleOrderService)
        {
            $this->saleOrderService  = $saleOrderService;
        }


    public function index($id)
        {
            return $this->saleOrderService->findSaleOrderModels($id);
        }
}
