<?php


namespace App\Services\SaleOrder;


use App\Models\SaleModelItem;
use App\Models\SaleOrder;
use App\Models\SaleOrderModels;

interface SaleOrderServiceInterface
{

    public function findById(int $saleOrderId);

    public function findSaleOrderModels(int $saleOrderId);

    public function createModelsOrder(array $request): SaleOrder;

    public function createSaleOrder(int $saleOrderId, array $model): SaleOrderModels;

//    create both sale order and assign models in the sale
    public function createSaleOrderAndAssignModelsOrder(array $saleOrderRequest, array $modelOrderRequest): SaleOrder;


    public function createOutStockItem(array $request): SaleModelItem;

    public function updateStatus(int $id, $status): SaleOrder;

    public function makeShipping(int $saleOrderId);







}
