<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class SupplierAddress extends Resource
{

    public static $displayInNavigation = false;


    public static $group = 'Supplier';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\SupplierAddress';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'street';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
//    public static $search = [
//        'street', 'country', 'postcode', 'city', 'state',
//    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

//            Country Fields
            BelongsTo::make('Suppliers')
            ->searchable(),

            Place::make('Address', 'street')
            ->country('country')
            ->postalCode('postcode')
                ->city('city')
            ->state('state')
                ->countries(['AU']),

            Country::make('country'),

            Text::make('postcode'),

            Text::make('city'),

            Text::make('state'),




            Select::make('type')->options([
                'postal' => 'postal',
                'shipping' => 'shipping',
            ]),
        ];
    }

}
