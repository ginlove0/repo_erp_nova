<?php

namespace App\Nova;

use App\Nova\Actions\OutStockItem;
use App\Nova\Actions\UpdateItemInstock;
use App\Nova\Filters\ItemConditionFilter;
use App\Nova\Filters\ItemLocation;
use App\Nova\Filters\ItemStockType;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

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

    public function subtitle() {

        return "Model: {$this->models->name}" .  " Condition: {$this->conditions->name}" . " WhLocation: {$this->whlocations->name}";
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'serialNumber', 'aliasModel'
    ];

    public static $trafficCop = false;

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


            Text::make("Alias Model", "aliasModel")
                ->displayUsing(function ($value) {
                    return str_limit($value, '15', '...');
                }),

            Text::make("SN", "serialNumber")

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
            -> hideWhenUpdating()
                ->sortable(),

            Date::make('Created At', 'created_at', function($value){
                return $value->format('m/d/Y');
            })
                -> hideWhenCreating()
                ->hideWhenUpdating()
            ->sortable(),

            Date::make('Updated At', 'updated_at', function($value){
                return $value->format('m/d/Y');
            })
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->sortable(),


            BelongsTo::make("Sale Order", 'saleorder')
            ->onlyOnDetail(),

            Number::make("Quantity", "quantity")
            ->hideFromIndex(),

            Text::make("Location", "location")
                ->sortable(),

            BelongsTo::make("Condition", 'conditions')
                ->sortable(),

            BelongsTo::make("WHLocation", 'whlocations')
                ->sortable(),

            Text::make('Note', 'note')->displayUsing(function ($value) {
                return str_limit($value, '15', '...');
            }) -> onlyOnIndex(),

            Textarea::make('Note', 'note') -> hideFromIndex(),

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
        return [
        ];
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
            new ItemLocation,
            new ItemConditionFilter


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
        return [
            new OutStockItem,
            new UpdateItemInstock,
        ];
    }

}
