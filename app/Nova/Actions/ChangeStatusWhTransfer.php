<?php

namespace App\Nova\Actions;

use App\Nova\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class ChangeStatusWhTransfer extends Action
{
    use InteractsWithQueue, Queueable;

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
        foreach ($models as $model)
        {
            $model->forceFill(["status" => $fields->status])->save();
                $getItems = \App\Models\Item::where('wh_transfer_id', $model->id)->get();

                foreach ($getItems as $getItem)
                {
                    if($fields->status == 'PREPARING' || $fields->status == 'CANCELED')
                    {
                        if($model-> whTransferLocationId == 2)
                        {
                            $holdLocationId = 2;
                        }else{
                            $holdLocationId = 1;
                        }
                        $getItem -> whlocationId = $holdLocationId;
                        $getItem -> save();

                    }
                    if($fields->status == 'TRANSFERRING')
                    {
                        if($model -> whTransferLocationId == 2)
                        {
                            $newLocationId = 4;
                        }else{
                            $newLocationId = 3;
                        }
                        $getItem -> whlocationId = $newLocationId;
                        $getItem -> save();
                    }

                    if($fields -> status == 'RECEIVED')
                    {
                        if($model -> whTransferLocationId == 1)
                        {
                            $arriveLocation = 2;
                        }else{
                            $arriveLocation = 1;
                        }
                        $getItem -> whlocationid = $arriveLocation;
                        $getItem -> save();
                    }

                }



            $this->markAsFinished($model);
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
            Select::make('Status')
                ->options([
                    'PREPARING' => 'Preparing',
                    'TRANSFERRING' => 'Transferring',
                    'RECEIVED' => 'Received',
                    'CANCELED' => 'Cancel'
                ])
        ];
    }
}
