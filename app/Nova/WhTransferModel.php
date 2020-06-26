<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;


class WhTransferModel extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */

    public static $displayInNavigation = false;

    public static $model = 'App\Models\WhTransferModel';

    public static $group='Warehouse Transfer';
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

    public static $perPageOptions = [30];

    public static $perPageViaRelationship = 30;
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('WhTransfer'),

            BelongsTo::make('Models', 'models')
            ->searchable(),

            BelongsTo::make('Condition', 'conditions')->default(3000),

            Number::make('Qty', 'qty'),


            Textarea::make('Note', 'note')->alwaysShow()
            ->showOnIndex()
        ];
    }


}
