<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class SupplierPayment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */

    public static $displayInNavigation = false;
    public static $model = 'App\Models\SupplierPayment';

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
            Select::make('Currency', 'currency')
            ->options([
                'AU' => 'AU',
                'US' => 'US'
            ]),
            Text::make('Bank Name', 'bankName'),
            Text::make('Bank Branch', 'bankBranch'),
            Text::make('Account Name', 'accountName')
            ->rules('required', 'max:255'),
            Number::make('BSB', 'BSB')
            ->rules('required', 'max:6'),
            Number::make('Account Number', 'accountNumber')
            ->rules('required', 'max:12'),
            Text::make('Paypal', 'paypal')


        ];
    }
}
