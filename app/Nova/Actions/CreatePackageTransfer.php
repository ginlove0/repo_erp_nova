<?php

namespace App\Nova\Actions;

use App\Models\Item;
use App\Models\WhTransferModel;
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
        Log::info($fields);
        $notInstockArray = [];
        $inTransferArray = [];
        $myArrs = explode(',', $fields->transfer_items);
        foreach ($models as $model)
        {
            foreach($myArrs as $myArr){

                if($myArr){
                    $removeTrim = trim($myArr);

                    $getItem = Item::where('serialNumber', $removeTrim) -> first();

                    if($getItem){
                        if($getItem -> wh_transfer_id)
                        {
                            $getItem -> wh_transfer_id = null;
                            $getItem -> save();
                        }

                        if($getItem -> transfer_pack)
                        {
                            $getItem -> transfer_pack = null;
                            $getItem -> save();
                        }

                        if($getItem -> stockStatus == false){
                            $getItem -> stockStatus = true;
                            $getItem -> save();
                        }

                        if($getItem -> whlocationId == 1 || $getItem -> whlocationId == 2)
                        {
                            $getItem -> transfer_pack = $model -> transfer_pack;
                            $getItem -> wh_transfer_id = $model -> id;
                            $getItem -> save();
                        }else{
                            array_push($inTransferArray, $getItem->serialNumber);
                        }
                    }else{
                        array_push($notInstockArray, $removeTrim);
                    }



                }
            }

        }
        if($inTransferArray)
        {
            return Action::danger('This item '. implode(',', $inTransferArray). ' in transferring! Please check again!');
        }
        if($notInstockArray)
        {
            return Action::danger('This item ' . implode(',', $notInstockArray) .' not in stock. Please check again!');

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
