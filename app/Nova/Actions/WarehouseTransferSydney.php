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

class WarehouseTransferSydney extends Action
{
    use InteractsWithQueue, Queueable;

    public $name='Make list items transfer to Sydney';
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
        Log::info($fields);
        $myArrs = explode(',', $fields->list_items_to_sydney);

        foreach ($myArrs as $myArr){
            $removeTrim = trim($myArr);
            //check sn in DB
            $newItem = Item::where('serialNumber', $removeTrim)->first();
            if($newItem) {
                $newItem->whlocationId = 1;
                $newItem->save();
            }
        }

        return Action::message('Transfer to Sydney success');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            CreatableHasmanyRelationField::make('List items to Sydney')
        ];
    }
}
