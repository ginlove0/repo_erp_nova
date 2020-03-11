<?php

namespace App\Nova;


//use App\Nova\Actions\AddItemToSaleOrder;
use App\Nova\Actions\PackedChange;
use App\Nova\Actions\ShippingChange;
use App\Nova\Actions\StatusChangeAction;
use Illuminate\Http\Request;
use Ipsupply\CheckoutItemResourceTool\CheckoutItemResourceTool;
use Ipsupply\CreatableHasmanyRelationField\CreatableHasmanyRelationField;
use Ipsupply\SaleOrderModelsField\SaleOrderModelsField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;

use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use Inspheric\Fields\Indicator;
use function foo\func;

class SaleOrder extends Resource
{



    public static $group = 'Sale';


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\SaleOrder';

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
            ID::make(),

            BelongsTo::make('Sender', 'senders'),

//            NovaBelongsToDepend::make('Supplier')
//                ->options(\App\Models\Supplier::take(10)->get(["id", "name"]))
//
//            ->hideWhenUpdating()
//            ,

            NovaBelongsToDepend::make('Supplier')
                ->options(\App\Models\Supplier::all())
                ->searchable()
                ->hideWhenUpdating(),




            NovaBelongsToDepend::make('Representative', 'representatives')
                ->optionsResolve(function ($supplier) {
                    return $supplier->representatives;
                })
                ->dependsOn('Supplier')
                ->hideFromIndex()
                ->hideWhenUpdating(),





            NovaBelongsToDepend::make('Billing Address', 'billingaddresses', SupplierAddress::class)
                ->optionsResolve(function ($supplier) {
                    return $supplier->supplieraddresses;
                })
                ->dependsOn('Supplier')
                ->hideFromIndex()
                ->hideWhenUpdating(),


            NovaBelongsToDepend::make('Shipping Address', 'shippingaddresses', SupplierAddress::class)
                ->optionsResolve(function ($supplier) {
                    return $supplier->supplieraddresses;
                })
                ->dependsOn('Supplier')
                ->hideWhenUpdating(),


            NovaBelongsToDepend::make('Invoice Email', 'supplierinvoiceemails', SupplierEmail::class)
                ->optionsResolve(function ($supplier) {
                    return $supplier->supplieremails;
                })
                ->dependsOn('Supplier')
                ->hideFromIndex()
                ->hideWhenUpdating(),


            NovaBelongsToDepend::make('Tracking Email', 'suppliertrackingemails', SupplierEmail::class)
                ->optionsResolve(function ($supplier) {
                    return $supplier->supplieremails;
                })
                ->dependsOn('Supplier')
            -> hideFromIndex()
                ->hideWhenUpdating(),


            BelongsTo::make('Warehouse', 'whlocations', WHLocation::class)
                ->hideFromIndex(),


            Text::make('Link Ebay', 'link_ebay', function () {
                $linkEbay = $this -> link_ebay;
                return "<a href='{$linkEbay}'>{$linkEbay}</a>";
            })->asHtml(),



//
            Indicator::make('Status')
                ->labels([
                    'pending' => 'Pending',
                    'complete' => 'Complete',
                    'cancel' => 'Cancel',
                    'draft' => 'Draft',
                    'confirm' => 'Confirm',
                    'close' => 'Close'
                ])
                ->colors([
                    'pending' => 'grey',
                    'draft' => 'grey',
                    'confirm' => 'blue',
                    'close' => 'green',
                    'complete' => 'green',
                    'cancel' =>'red',
                ])
                ->onlyOnIndex(),



            Indicator::make('Shipped')
                ->labels([
                    'full' => 'All Shipped',
                    'partial' => 'Partially Shipped',
                ])
                ->colors([
                    'partial' => 'blue',
                    'full' => 'green'
                ])
                ->onlyOnIndex(),

            Indicator::make('Invoiced')
                ->labels([
                    'full' => 'All Invoiced',
                    'partial' => 'Partially Invoiced',
                ])
                ->colors([
                    'partial' => 'blue',
                    'full' => 'green'
                ])
                ->onlyOnIndex(),


            Indicator::make('Packed')
                ->labels([
                    'full' => 'All Packed',
                    'partial' => 'Partially Packed',
                ])
                ->colors([
                    'partial' => 'blue',
                    'full' => 'green'
                ])
                ->onlyOnIndex(),

//            HasMany::make('SaleOrderModels'),

//            MorphMany::make('saleordermodeltype')
//
        HasMany::make('saleordermodeltype')



//            CheckoutItemResourceTool::make("SaleOrderModelType")




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
        return [
            new StatusChangeAction,
            new ShippingChange,
            new PackedChange,
        ];
    }
}
