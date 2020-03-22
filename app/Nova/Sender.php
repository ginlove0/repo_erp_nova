<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Text;

class Sender extends Resource
{


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $group = 'Sale';
    public static $model = 'App\Models\Sender';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'company';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'company', 'phoneNumber', 'ceo', 'address'
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
            Text::make('Company')->rules('required'),
            Number::make('Phone Number', 'phoneNumber'),
            Text::make('CEO', 'ceo')->rules('required'),
            Place::make('Address')->rules('required')

        ];
    }

}
