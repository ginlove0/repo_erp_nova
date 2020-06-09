<?php

namespace App\Nova;

use App\Models\Item;
use App\Nova\Actions\CopySerialNumberAction;
use App\Nova\Actions\MakeTestStatusDone;
use App\Nova\Actions\OutStockItem;
use App\Nova\Filters\CreatedDateFilter;
use App\Nova\Filters\FilterByTodayAndYesterdayItem;
use App\Nova\Filters\ItemConditionFilter;
use App\Nova\Filters\ItemLocation;
use App\Nova\Filters\ItemStockType;
use App\Services\Item\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ipsupply\UpdateItemInStock\UpdateItemInStock;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ManagementItem extends Resource
{

    public static $group = "Review";
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

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'serialNumber',
    ];

    public static function softDeletes()
    {
        return false;
    }

    public static $perPageOptions = [100, 200, 1000];

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
                ->searchable(),



            Text::make("Alias Model", "aliasModel")
                ->displayUsing(function ($value) {
                    return str_limit($value, '20', '...');
                })
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
                return "<a class=\"no-underline font-bold dim text-primary\" href='http://127.0.0.1:8000/resources/items/$value->id'>$value->serialNumber</a>";
            })
                ->asHtml()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make("Supplier", "suppliers")
                ->searchable(),

            Text::make('Status', 'id', function($id){
                $item = Item::where('id', $id)->first();
                    if($item -> updated_at == $item -> created_at)
                    {
                        return 'New';
                    }
                    else{
                        return 'Update';
                    }

            })
                -> hideWhenCreating()
                -> hideWhenUpdating()
                ->sortable(),


            Date::make('Date', 'updated_at', function($value){
                if($value){
                    return $value -> format('H:i d/m');
                }
                return null;
            })
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->sortable(),

            Text::make('Tested', 'test_status', function( $value){
                if(!$value){
                    return '__';
                }
                if($value == 'Need test'){
                    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-labelledby="x-circle" role="presentation" class="fill-current text-danger"><path d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"></path></svg>';
                }

                if($value == 'Done'){
                    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-labelledby="check-circle" role="presentation" class="fill-current text-success"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"></path></svg>';
                }
            })
                ->asHtml()
            ->sortable(),


            BelongsTo::make("Sale Order", 'saleorder')
                ->onlyOnDetail(),

            Text::make("Location", "location")
                ->sortable()
                ->nullable(),

            BelongsTo::make("WHLocation", 'whlocations')
                ->sortable(),

            BelongsTo::make("Wh Transfer", "whtransfer")
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->hideFromIndex(),

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
        return [
            new FilterByTodayAndYesterdayItem,
            new ItemStockType,

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
            new OutStockItem,
            new MakeTestStatusDone,
            new CopySerialNumberAction
        ];
    }
}
