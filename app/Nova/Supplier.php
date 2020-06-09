<?php

namespace App\Nova;

use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\HasMany;

class Supplier extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */

    public static $group = 'Tool';

    public static $model = 'App\Models\Supplier';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'contactType',
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
            ID::make()->sortable(),
            Text::make('Name')
                ->resolveUsing(function($name) {
                    return strtoupper($name);
                })
                ->rules('required', 'max:255')
                ->sortable(),

            Select::make('Contact Type', 'contactType')
                ->options([
                'Gov' => 'Gov',
                'Corp' => 'Corp',
                'Broker' => 'Broker',
                'Individual' => 'Individual'
            ]),

            Select::make('Pricing Level', 'pricingLevel')->options([
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
            ]),





            (new Tabs('Tabs', [
                'Sale Order' => [
                    HasMany::make('Sale Order', 'saleorders', SaleOrder::class)
                ],
                'Representative' => [
                    HasMany::make("Representative", 'representatives'),
                ],
                'Address' => [
                    HasMany::make('Address', 'supplieraddresses', SupplierAddress::class),
                ],

                'Email' => [
                    HasMany::make('Email', 'supplieremails', SupplierEmail::class)
                ],
                'Payment' => [
                    HasMany::make('Payment', 'supplierpayments', SupplierPayment::class)
                ],
                'Shipping Account' => [
                    HasMany::make('Shipping Account', 'couriersuppliers', SupplierCourier::class)
                ],
                'Note' => [
                    HasMany::make('Note', 'suppliernotes', SupplierNote::class)
                ],
                'Items' => [
                    HasMany::make('Items', 'items', Item::class)
                ]



            ]))->defaultSearch(true),







        ];
    }


    protected function addressesFields()
    {
        return [
            HasMany::make('Supplier Address', 'supplieraddresses', 'App\Models\SupplierAddress')
        ];
    }


    protected function extraInfoFields()
    {
        return [

            Textarea::make('IPS Policy','ipsPolicy'),


            Textarea::make('Warranty Policy','warrantyPolicy'),


            Textarea::make('IPS Term','ipsTerm'),

            Text::make('Customer Term','customerTerm')
                ->rules("max:255"),


            Textarea::make('Note for Shipping','noteShipping'),



            Textarea::make('Note for Receiving','noteReceiving'),


        ];
    }

}
