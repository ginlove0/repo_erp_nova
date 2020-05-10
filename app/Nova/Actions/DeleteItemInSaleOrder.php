<?php

namespace App\Nova\Actions;

use App\Models\Item;
use App\Models\Model;
use App\Models\SaleOrder;
use App\Models\SaleOrderModelType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Ipsupply\DeleteItemsInSaleOrder\DeleteItemsInSaleOrder;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Console\Concerns\AcceptsNameAndVendor;
use Laravel\Nova\Fields\ActionFields;

class DeleteItemInSaleOrder extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Delete Item Added In Sale Order';
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */




    public function handle(ActionFields $fields, Collection $models)
    {
        //

        $itemArrays = $fields -> item;
        $newArray = json_decode($itemArrays);

        foreach ($models as $model){
            foreach ($newArray as $getItem){

                $itemArray = $getItem->items;

                foreach ($itemArray as $item) {

                    //if serial number bang null thi se ko add vao array
                    $serialInputArray = [];
                    if($item -> serialNumber != ""){
                        array_push($serialInputArray, $item->serialNumber );
                    }

                    $newItem = Item::where('serialNumber', $item -> serialNumber)->first();
                    if($newItem && $newItem->stockStatus == false){
                        $newItem->stockStatus = true;
                        $newItem->sale_order_id = null;
                        $newItem->save();

                        $updateSaleOrderModelType = \App\Models\SaleOrderItem::where('id', $getItem -> id)->first();

                        if($updateSaleOrderModelType){
                            $updateSaleOrderModelType -> qty = $updateSaleOrderModelType -> qty + count($serialInputArray);
                            $updateSaleOrderModelType -> shipped -= count($serialInputArray);
                            $updateSaleOrderModelType -> save();
                        }

                    }
                }
            }
        }






//        $newArrays = [];
//
//        $myArrs = explode(',', $fields->item);
//
//        foreach ($models as $model) {
//            $sale_orders = SaleOrderModelType::where('sale_order_id', $model->id)->get();
//            $counting = count($myArrs);
//
//            foreach ($myArrs as $myArr) {
//                $removeTrim = trim($myArr);
//
//                if (!in_array($removeTrim, $newArrays)) {
//                    array_push($newArrays, $removeTrim);
//
//
//                    $items = Item::where('serialNumber', $removeTrim)->first();
//
//                    if ($items) {
//                        $items -> stockStatus = true;
//                        $items -> sale_order_id = null;
//                        $items -> save();
//
//                    }
//                }
//
//            }
//
//            if($sale_orders){
//                foreach ($sale_orders as $sale_order){
//
//                        if($sale_order && $sale_order -> shipped > 0 && $sale_order -> shipped <= $counting ){
//                            $sale_order -> qty += $sale_order -> shipped;
//                            $counting -=  $sale_order -> shipped;
//                            $sale_order -> shipped = 0;
//                            $sale_order -> save();
//                            if($counting == 0){
//                                return Action::message('Success');
//                            }
//
//                        }elseif ($sale_order && $sale_order -> shipped > 0 && $sale_order -> shipped > $counting ){
//                            $sale_order -> qty += $counting;
//                            $sale_order -> shipped -= $counting;
//                            $counting = 0;
//                            $sale_order -> save();
//                            if($counting == 0){
//                                return Action::message('Success');
//                            }
//                        }
//                        $counting -> save();
//
//                }
//
//            }
//
//
//        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            DeleteItemsInSaleOrder::make('Item')
        ];
    }
}
