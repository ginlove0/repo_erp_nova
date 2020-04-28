<?php

namespace App\Nova\Actions;

use App\Models\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Ipsupply\ItemToOutStock\ItemToOutStock;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class OutStockItem extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = "Make a list item out-stock";

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

        //
        $myArrs = explode(',', $fields->items_to_out_stock);
        foreach ($myArrs as $myArr){
            $removeTrim = trim($myArr);

            //check sn in DB
            $newItem = Item::where('serialNumber', $removeTrim)->first();
            if($newItem && $newItem->stockStatus == true) {
                $newItem->stockStatus = false;
                $newItem->save();
            }
        }

        return Action::message('Out stock success');


    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            ItemToOutStock::make('Items to out stock')
        ];
    }
}
