<?php

namespace App\Nova;

use App\Services\SaleOrder\SaleOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ipsupply\DisplayQtySaleOrderItemField\DisplayQtySaleOrderItemField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SaleOrderItem extends Resource
{

    private $saleOrderService;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->saleOrderService = new SaleOrderService();
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\SaleOrderItem';

    public static $group='Sale';

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
            BelongsTo::make('Model', 'models')
            ->searchable(),
            BelongsTo::make('Condition', 'conditions'),

            BelongsTo::make('Sale Order', 'sale_order'),

            Number::make('Require qty','qty')
            ->hideFromDetail(),

            DisplayQtySaleOrderItemField::make('Qty', 'id', function($data){
                $saleOrderItems = \App\Models\SaleOrderItem::where('id', $data)->get();

                foreach ($saleOrderItems as $saleOrderItem)
                {
                    $newData = $saleOrderItem -> qty;
                    $saleOrder = \App\Models\SaleOrder::where('id', $saleOrderItem -> sale_order_id)->first();
                    if($newData > 0)
                    {
                        $saleOrder->packed = 'partial';
                        $saleOrder->shipped = 'partial';
                        $saleOrder->status = 'confirm';
                        $saleOrder->save();
                    }
                }
                return $newData;
            }) -> onlyOnDetail(),

            Number::make('Shipped', 'shipped')
            ->onlyOnIndex(),
            Number::make('Price','price'),
            Text::make('Note',' note')

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
        return [];
    }
}
