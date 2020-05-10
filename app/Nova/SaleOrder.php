<?php

namespace App\Nova;


use App\Nova\Actions\DeleteItemInSaleOrder;
use App\Nova\Actions\ShippingChange;
use App\Nova\Actions\StatusChangeAction;
use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Ipsupply\CheckoutItemResourceTool\CheckoutItemResourceTool;
use Ipsupply\WarehouseTransferField\WarehouseTransferField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Manmohanjit\BelongsToDependency\BelongsToDependency;
use OptimistDigital\NovaNotesField\NotesField;


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
            ID::make(),

            BelongsTo::make('Sender', 'senders'),



            BelongsTo::make('Customer', 'supplier', 'App\Nova\Supplier'),


            BelongsToDependency::make('Representative', 'representatives')
                ->dependsOn('supplier', 'supplierId')
                ->hideFromIndex(),

            BelongsToDependency::make('Billing Address', 'billingaddresses', SupplierAddress::class)
                ->dependsOn('supplier', 'supplierId')
                ->hideFromIndex()
                ->required(false),

            BelongsToDependency::make('Shipping Address', 'shippingaddresses', SupplierAddress::class)
                ->dependsOn('supplier', 'supplierId')
                ->hideFromIndex(),

            BelongsToDependency::make('Invoice Email', 'supplierinvoiceemails', SupplierEmail::class)
                ->dependsOn('supplier', 'supplierId')
                ->hideFromIndex()
                ->required(false),

            BelongsToDependency::make('Tracking Email', 'suppliertrackingemails', SupplierEmail::class)
                ->dependsOn('supplier', 'supplierId')
                ->hideFromIndex()
                ->required(false),



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
                ->hideFromIndex()
                ->searchable(),




            WarehouseTransferField::make('PDF file', 'attachment', function($value)
            {
                if($value)
                {
                    return 'http://127.0.0.1:8000/storage/pdf/' . $value;
                }
                return null;
            })
            ->hideWhenCreating()
            ->hideWhenUpdating(),

            File::make('Attachment', 'attachment')
                ->disk('pdf')
                ->storeOriginalName('attachment_name')
                ->storeSize('attachment_size')
                ->prunable()
                ->acceptedTypes('.pdf')
                ->hideFromIndex(),

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
                ->onlyOnIndex()
                ->sortable(),



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


//            HasMany::make('Sale Order Model Type','saleordermodeltype'),

//            HasMany::make('Sale Order Models', 'saleordermodels'),



//            HasMany::make('Items', 'item'),

            HasMany::make('SaleOrderItem', 'sale_order_item'),

            CheckoutItemResourceTool::make('SaleOrderItem'),

            NotesField::make('Notes')
            ->placeholder('Add Note')
            ->onlyOnDetail()










        ];
    }

    public function actions(Request $request)
    {
        return [
            new StatusChangeAction,
            new ShippingChange,
            new DeleteItemInSaleOrder,
//            new CreateInvoiceSaleOrder
        ];
    }



}
