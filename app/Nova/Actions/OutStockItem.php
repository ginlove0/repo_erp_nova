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

    public $name = "Make item(s) need to test";


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
        foreach ($models as $model){
            $model -> test_status = 'Need test';
            $model -> timestamps = false;

            $model -> save();
        }

        return Action::message('Update test status to Need test success!');


    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
//            ItemToOutStock::make('Items to out stock')
        ];
    }
}
