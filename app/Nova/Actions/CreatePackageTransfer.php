<?php

namespace App\Nova\Actions;

use App\Models\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Ipsupply\CreatePackageWhtransfer\CreatePackageWhtransfer;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class CreatePackageTransfer extends Action
{
    use InteractsWithQueue, Queueable;

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

        Log::info($models);
        $myArrs = explode(',', $fields->transfer_items);
        foreach ($models as $model)
        {
//            if($model -> whTransferLocationId === 1)
//            {
//                $whlocationtransfer = 3;
//            }else
//            {
//                $whlocationtransfer = 4;
//            }
            foreach($myArrs as $myArr){

                if($myArr){
                    $removeTrim = trim($myArr);

                    $getItem = Item::where('serialNumber', $removeTrim) -> first();

                    if($getItem -> wh_transfer_id)
                    {
                        $getItem -> wh_transfer_id = null;
                    }

                    if($getItem && $getItem -> whlocationId != 3 && $getItem -> whlocationId != 4 && $getItem -> stockStatus == true)
                    {
//                        $getItem -> whlocationId = $whlocationtransfer;
                        $getItem -> wh_transfer_id = $model -> id;
                        $getItem -> save();
                    }
                    if($getItem && $getItem -> whlocationId === 3 || $getItem -> whlocationId === 4)
                    {
                        return Action::danger('This item '. $getItem->serialNumber.' in transferring! Please check again!');
                    }
                    if($getItem && $getItem -> whlocationId != 3 && $getItem -> whlocationId != 4 && $getItem -> stockStatus == false)
                    {
                        return Action::danger('This item ' . $getItem -> stockStatus . ' not in stock. Please check again!');
                    }

                }
            }
        }

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            CreatePackageWhtransfer::make('Transfer items')
        ];
    }
}
