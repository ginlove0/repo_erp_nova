<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Ipsupply\CreatePackagesShipping\CreatePackagesShipping;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

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
        //
        foreach($models as $model) {

            $model->forceFill(["shipped" => $fields->status]);
            $model->forceFill(["status" => 'complete']);
            $model->save();

            $this->markAsFinished($model);
        }

        return Action::message('Selected sale order are now '.$fields->status . ' shipped');
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
                    'full' => 'full',
                    'partial' => 'partial',

                ]),
            CreatePackagesShipping::make("SaleOrder"),

        ];
    }
}
