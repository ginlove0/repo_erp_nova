<?php

namespace App\Nova\Actions;

use App\Models\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Ipsupply\CreatableHasmanyRelationField\CreatableHasmanyRelationField;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class UpdateItemInstock extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Make a list item in-stock';

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
        Log::info($fields, ['']);
        $myArrs = explode(',', $fields->items_to_instock);
        foreach ($myArrs as $myArr){
            $removeTrim = trim($myArr);

            //check sn in DB
            $newItem = Item::where('serialNumber', $removeTrim)->first();
            if($newItem && $newItem->stockStatus == false) {
                $newItem->stockStatus = true;
                $newItem->save();
            }
        }

        return Action::message('In stock success');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
           \Ipsupply\UpdateItemInStock\UpdateItemInStock::make('Items to instock')
        ];
    }
}
