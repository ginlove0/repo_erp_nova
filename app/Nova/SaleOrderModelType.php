<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;

class SaleOrderModelType extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $displayInNavigation = false;

    public static $model = 'App\Models\SaleOrderModelType';


    public static $group = 'Sale';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            MorphTo::make('Model', 'sale_model')->types([
                EbayModel::class,
                Model::class
            ]) -> searchable(),
            BelongsTo::make('SaleOrder'),
            BelongsTo::make('Condition'),
            Number::make('Quantity', 'qty')
            ->hideFromIndex(),
            Number::make('Remaining qty', 'qty')
            ->onlyOnIndex(),
            Number::make('Shipped qty', 'shipped')
            ->onlyOnIndex(),
            Number::make('Price')
        ];
    }

}
