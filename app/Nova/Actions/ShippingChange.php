<?php

namespace App\Nova\Actions;

use App\Models\Item;
use App\Models\SaleOrderItem;
use App\Models\SaleOrderPackedItem;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Ipsupply\CreatePackagesShipping\CreatePackagesShipping;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ShippingChange extends Action
{
    use InteractsWithQueue, Queueable;


    public $name = "Create Packages";

    public $onlyOnDetail = true;
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        //array nay de luu so serial number input


        $transferingArray = [];

        $notInstockArray = [];
        //array nay de lay data input ve (cai nay type la string)
        $array = $fields->saleorder;

        //vi type string nen dung json_decode de convert thanh array
        $newArray = json_decode($array);

        foreach($models as $model) {

        foreach ($newArray as $getItem  ) {
            $itemArray = $getItem->items;


            foreach ($itemArray as $item) {
                //if serial number bang null thi se ko add vao array
                $serialInputArray = [];

                if ($item->serialNumber != "") {
                    array_push($serialInputArray, $item->serialNumber);
                }

                //get serial number trong database va serial input, neu bang nhau thi set stockStatus => outstock

                $newItem = Item::where('serialNumber', $item->serialNumber)->first();
                    Log::info($newItem, ['in shipping change']);

                if ($newItem) {
                    if($newItem->stockStatus == true){
                        if ($newItem->whlocationId == 1 || $newItem->whlocationId == 2)
                        {
                            $newItem->stockStatus = false;
                            $newItem->save();


                            SaleOrderPackedItem::create([
                                'sale_order_id' => $model->id,
                                'item_id' => $newItem->id,
                                'modelId' => $newItem->modelId,
                                'conditionId' => $newItem->conditionId,
                                'whlocationId' => $newItem->whlocationId
                            ]);

                            //update quantity trong sale order. Khi 1 sn outstock thi qty se giam di
                            $updateSaleOrderModelType = SaleOrderItem::where('id', $getItem->id)->first();
                            if ($updateSaleOrderModelType) {
                                $updateSaleOrderModelType->qty = $updateSaleOrderModelType->qty - count($serialInputArray);

                                //check so luong quantity, neu lon hon 0 thi status cua packed => partial
                                if ($updateSaleOrderModelType->qty > 0) {
                                    $model->packed = 'partial';
                                    $model->shipped = 'partial';
                                    $model->status = 'confirm';
                                    $model->save();
                                    $this->markAsFinished($model);
                                } //neu so luong qty = 0 thi doi status packed thanh all packed
                                else {
                                    $model->packed = 'full';
                                    $model->shipped = 'full';
                                    $model->status = 'complete';
                                    $model->save();
                                    $this->markAsFinished($model);
                                }
                                $updateSaleOrderModelType->shipped += count($serialInputArray);
                                $updateSaleOrderModelType->save();
                            }

                        }
                        else{
                            array_push($transferingArray, $newItem->serialNumber);
                        }
                    }else{
                        array_push($notInstockArray, $newItem->serialNumber);
                    }
                }
            }
        }

        if($transferingArray != null)
        {
            return Action::danger('Items ' . json_encode($transferingArray) . 'in transferring now! Please check again');
        }

        if($notInstockArray != null)
        {
            return Action::danger('Items ' . json_encode($notInstockArray) . 'not in stock now! Please check again');
        }


    }






//        return Action::message('Selected sale order are now '.$fields->status . ' shipped');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {

        return [

            CreatePackagesShipping::make("SaleOrder")->required(),

        ];
    }
}
