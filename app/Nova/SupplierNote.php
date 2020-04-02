<?php

namespace App\Nova;

use DigitalCloud\NovaResourceNotes\Fields\Notes;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Textarea;

class SupplierNote extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $displayInNavigation = false;
    public static $model = 'App\Models\SupplierNote';


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
//    public static $search = [
//        'id',
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
            BelongsTo::make('Suppliers', 'suppliers'),
//            KeyValue::make('Note')
//                -> keyLabel( 'Date') ->withMeta(['value' => now()->format('Y-m-d h:m:s')])
//            ->valueLabel('Note')
//            ->actionText('Add Note'),
//            DateTime::make('Created At', 'created_at')->withMeta([
//                'value' => now()->format('Y-m-d h:m:s')
//            ]),
            Date::make('Created At')->format('DD MMM YYYY'),
            Textarea::make('Note', 'internalNote') -> alwaysShow()

//            Notes::make('Note', 'internalNote')

        ];
    }

}
