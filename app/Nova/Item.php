<?php

namespace App\Nova;

use App\Nova\Actions\MakeTestStatusDone;
use App\Nova\Actions\OutStockItem;
use App\Nova\Filters\CreatedDateFilter;
use App\Nova\Filters\ItemConditionFilter;
use App\Nova\Filters\ItemLocation;
use App\Nova\Filters\ItemStockType;
use App\Nova\Filters\PaginationHasManyItemField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ipsupply\ShowDetailByHover\ShowDetailByHover;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Item extends Resource
{

    public static $group = "Product";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Item';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'serialNumber';

    public function subtitle() {

        return "Model: {$this->models->name}" .  " Condition: {$this->conditions->name}" . " WhLocation: {$this->whlocations->name}";
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'serialNumber', 'aliasModel'
    ];

    public static $perPageViaRelationship = 50;


//    public static function softDeletes()
//    {
//        return false;
//    }

    public static $perPageOptions = [50, 100, 200, 1000];

//    public static function indexQuery(NovaRequest $request, $query)
//    {
//        $whlocationId = \App\Models\Item::where('whlocationId', 2);
//
//        return $query->where('whlocationId', 2);
//    }

    public static $trafficCop = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {

        return [

            BelongsTo::make("Model", 'models')
                ->sortable()
                ->searchable(),



            ShowDetailByHover::make("Alias Model", "aliasModel")
                -> hideFromDetail()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Text::make("Alias Model", "aliasModel")
                ->hideFromIndex(),

            Text::make("SN", "serialNumber")
                ->hideFromDetail()
                ->hideFromIndex()
                ->hideWhenCreating(),

            Text::make("SN", function($value){
                return "<a class=\"no-underline font-bold dim text-primary\" href='http://admin.ipsupply.net/nova/resources/items/$value->id'>$value->serialNumber</a>";
            })
                ->asHtml()
            ->hideWhenCreating()
            ->hideWhenUpdating(),

            BelongsTo::make("Supplier", "suppliers")
                ->searchable(),

            Text::make('Stock status', 'stockStatus', function($status){

                if ($status === 0){
                    return 'Not in stock';
                }else{
                    return 'In stock';
                }
            })
            -> hideWhenCreating()
            -> hideWhenUpdating()
                ->sortable(),

            Date::make('Created At', 'created_at', function($value){
                if($value){
                    return $value -> format('d/m/y');
                }
                return null;
            })
                -> hideWhenCreating()
                ->hideWhenUpdating()
            ->sortable(),

            Date::make('Updated At', 'updated_at', function($value){
                if($value){
                    return $value -> format('d/m/y');
                }
                return null;
            })
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->sortable(),


            BelongsTo::make("Sale Order", 'saleorder')
            ->onlyOnDetail(),

            Number::make("Qty", "quantity"),

            Text::make("Location", "location")
                ->sortable()
                ->nullable(),

            BelongsTo::make("Condition", 'conditions')
                ->sortable(),

            BelongsTo::make("WHLocation", 'whlocations')
                ->sortable(),

            BelongsTo::make("Wh Transfer", "whtransfer")
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->hideFromIndex(),

            ShowDetailByHover::make('Note', 'note')
                ->onlyOnIndex(),

            Textarea::make('Test report', 'test_report')
                ->hideFromIndex()
                ->nullable(),

            Textarea::make('Note', 'note')
                ->hideFromIndex()
                ->alwaysShow(),

            Text::make('User', 'addedBy')
            ->onlyOnDetail(),




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
        return [
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new ItemStockType,
            new ItemLocation,
            new ItemConditionFilter,
            new CreatedDateFilter,
//            new PaginationHasManyItemField,


        ];
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
        ];
    }

}
