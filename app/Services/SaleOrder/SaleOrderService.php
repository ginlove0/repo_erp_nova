<?php


namespace App\Services\SaleOrder;


use App\Models\SaleModelItem;
use App\Models\SaleOrder;
use App\Models\SaleOrderModels;

class SaleOrderService implements SaleOrderServiceInterface
{


    public function createModelsOrder(array $request): SaleOrder
    {
        return SaleOrder::create($request);
    }

    public function createSaleOrder(int $saleOrderId, array $model): SaleOrderModels
    {

        return SaleOrderModels::create(
            array_merge($model, [
                "sale_order_id" => $saleOrderId
            ])
        );
    }

    public function createSaleOrderAndAssignModelsOrder(array $saleOrderRequest, array $modelOrderRequest): SaleOrder
    {
        $saleOrder = $this->createSaleOrder($saleOrderRequest);

        foreach ($modelOrderRequest as $model)
        {
            $saleId = $saleOrder->id;

            $this->createModelsOrder($saleId, $model);
        }

        return $saleOrder;
    }



    public function createOutStockItem(array $request): SaleModelItem
    {
        return SaleModelItem::create($request);
    }


    public function updateStatus(int $id, $status): SaleOrder
    {
       $saleOrder = SaleOrder::find($id);
        $saleOrder->status = $status;
        $saleOrder->save();

        return $saleOrder;

    }


//  make an out stock all order
    public function makeShipping(int $saleOrderId)
    {
        $saleOrder = $this->findById($saleOrderId);

//        $saleOrder->


    }


//    find sale order by if
    public function findById(int $saleOrderId)
    {
        return SaleOrder::find($saleOrderId);
    }

    public function findSaleOrderModels(int $saleOrderId)
    {
        $saleOrder = SaleOrderModels::where(['sale_order_id' => $saleOrderId])->with('models', 'condition')->get();

        return $saleOrder;
        // TODO: Implement findSaleOrderModels() method.
    }
}
