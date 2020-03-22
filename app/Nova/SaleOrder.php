<?php

namespace App\Nova;


use App\Nova\Actions\ShippingChange;
use App\Nova\Actions\StatusChangeAction;
use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Manmohanjit\BelongsToDependency\BelongsToDependency;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;


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



            BelongsTo::make('Supplier', 'supplier'),


            BelongsToDependency::make('Representative', 'representatives')
                ->dependsOn('supplier', 'supplierId')
                ->hideFromIndex(),

            BelongsToDependency::make('Billing Address', 'billingaddresses', SupplierAddress::class)
                ->dependsOn('supplier', 'supplierId')
                ->hideFromIndex(),

            BelongsToDependency::make('Shipping Address', 'shippingaddresses', SupplierAddress::class)
                ->dependsOn('supplier', 'supplierId')
                ->hideFromIndex(),

            BelongsToDependency::make('Invoice Email', 'supplierinvoiceemails', SupplierEmail::class)
                ->dependsOn('supplier', 'supplierId')
                ->hideFromIndex(),

            BelongsToDependency::make('Tracking Email', 'suppliertrackingemails', SupplierEmail::class)
                ->dependsOn('supplier', 'supplierId')
                ->hideFromIndex(),



//            NovaBelongsToDepend::make('Billing Address', 'billingaddresses', SupplierAddress::class)
//                ->optionsResolve(function ($supplier) {
//                    return $supplier->supplieraddresses;
//                })
//                ->dependsOn('Supplier')
//                ->hideFromIndex()
//                ->hideWhenUpdating(),


//            NovaBelongsToDepend::make('Shipping Address', 'shippingaddresses', SupplierAddress::class)
//                ->optionsResolve(function ($supplier) {
//                    return $supplier->supplieraddresses;
//                })
//                ->dependsOn('Supplier')
//                ->hideWhenUpdating(),
//
//
//            NovaBelongsToDepend::make('Invoice Email', 'supplierinvoiceemails', SupplierEmail::class)
//                ->optionsResolve(function ($supplier) {
//                    return $supplier->supplieremails;
//                })
//                ->dependsOn('Supplier')
//                ->hideFromIndex()
//                ->hideWhenUpdating(),


//            NovaBelongsToDepend::make('Tracking Email', 'suppliertrackingemails', SupplierEmail::class)
//                ->optionsResolve(function ($supplier) {
//                    return $supplier->supplieremails;
//                })
//                ->dependsOn('Supplier')
//            -> hideFromIndex()
//                ->hideWhenUpdating(),


            BelongsTo::make('Warehouse', 'whlocations', WHLocation::class)
                ->hideFromIndex(),



            Url::make('Link Ebay')
                ->clickableOnIndex((bool) $clickable = true)
                ->domainLabel(),




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
        HasMany::make('saleordermodeltype'),

            HasMany::make('item')



//            CheckoutItemResourceTool::make("SaleOrderModelType")




        ];
    }

    public function actions(Request $request)
    {
        return [
            new StatusChangeAction,
            new ShippingChange,
        ];
    }
}
