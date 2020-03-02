<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Item extends Resource
{

    public static $searchRelations = [
        'models' => ['name'],
        'suppliers' => ['name'],
        'conditions' => ['name'],
    ];
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
            Text::make("Serial Number", "serialNumber"),

            BelongsTo::make("Supplier", "suppliers")
                ->searchable()
,

            BelongsTo::make("Model", 'models')
                ->searchable()

                ->prepopulate(),


            BelongsTo::make("Condition", 'conditions')
                ->searchable()
                ->prepopulate()
,


            BelongsTo::make("WHLocation", 'whlocations')
                ->searchable()
                ->prepopulate(),


            Text::make('User', 'addedBy')

            ->default($request->user()->email)



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
        return [];
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
