<?php


namespace App\Services\SaleOrder;


use App\Models\Item;
use App\Models\SaleModelItem;
use App\Models\SaleOrder;
use App\Models\SaleOrderModels;
use App\Models\SaleOrderModelType;
use Illuminate\Support\Facades\Log;

class SaleOrderService implements SaleOrderServiceInterface
{


    public function createModelsOrder(array $request): SaleOrder
    {
        return SaleOrder::create($request);
    }

    public function createSaleOrder(int $saleOrderId, array $model): SaleOrderModelType
    {

        return SaleOrderModelType::create(
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
        $saleOrder = SaleOrderModelType::where('sale_order_id', $saleOrderId)->with('sale_model','condition')->get();

        return $saleOrder;
        // TODO: Implement findSaleOrderModels() method.
    }

    public function findItemsBySaleOrder(int $saleOrderId){
        $items = Item::where('sale_order_id', $saleOrderId)->with('models', 'old_models', 'conditions', 'suppliers', 'whlocations')->get();

        return $items;
    }

    public function findItemBySN(int $itemId){
        return Item::where("id" , $itemId)->firstOrFail();
    }
}
