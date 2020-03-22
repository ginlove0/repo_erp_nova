<?php

namespace App\Nova;

use App\Nova\Filters\ItemLocation;
use App\Nova\Filters\ItemStockType;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class Item extends Resource
{

    public static $group = "Product";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Item';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'serialNumber';
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'serialNumber', 'conditionId', 'modelId', 'supplierId'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {

        return [

            BelongsTo::make("Model", 'models')
                ->searchable(),

            Text::make("SN", "serialNumber")
            ->hideWhenUpdating()
            ->hideWhenCreating(),

            BelongsTo::make("Supplier", "suppliers")
                ->searchable(),

            Text::make('Stock status', 'stockStatus', function($status){

                if ($status === 0){
                    return 'Not in stock';
                }else{
                    return 'In stock';
                }
            })
            -> hideWhenCreating()
            -> hideWhenUpdating(),

            BelongsTo::make("Sale Order", 'saleorder')
            ->hideFromIndex()
            ->hideFromDetail()
            ->hideWhenCreating()
            ->hideWhenUpdating(),

            Number::make("Quantity", "quantity"),

            Text::make("Location", "location"),


            BelongsTo::make("Condition", 'conditions'),

            BelongsTo::make("WHLocation", 'whlocations'),


            Text::make('User', 'addedBy')
            ->onlyOnDetail(),



        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new ItemStockType,
            new ItemLocation
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
