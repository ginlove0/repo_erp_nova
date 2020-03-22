<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Representative extends Resource
{

    public static $displayInNavigation = false;

    public static $group = 'Supplier';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Representative';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'fullName';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
//    public static $search = [
//        'fullName',
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
            BelongsTo::make('Supplier', "suppliers"),


            Select::make('Salutation')->options([
                'Mr' => 'Mr',
                'Ms' => 'Ms',
                'Mrs' => 'Mrs',
                'Other' => 'Other',
            ]),


            Text::make('Full Name', 'fullName')->rules('required', 'max:255'),


            Text::make('Position', 'position')->rules( 'max:255'),

            Number::make("Phone Number", 'phoneNumber'),
        ];
    }
}
