<?php

namespace App\Http\Controllers;

use App\Services\SaleOrder\SaleOrderServiceInterface;
use Illuminate\Http\Request;

class SaleOrderController extends Controller
{
    //

    private $saleOrderService;
    public function __construct(SaleOrderServiceInterface $saleOrderService)
    {
        $this->saleOrderService  = $saleOrderService;
    }



    public function findSaleOrderModels($saleOrderId)
    {
        return $this->saleOrderService->findSaleOrderModels($saleOrderId);
    }


}

