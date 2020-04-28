<?php

namespace App\Nova;

use App\Nova\Actions\ChangeStatusWhTransfer;
use App\Nova\Actions\CreatePackageTransfer;
use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Ipsupply\ItemTransferResourceTool\ItemTransferResourceTool;
use Ipsupply\WhTransferItemPackedResourceTool\WhTransferItemPackedResourceTool;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class WhTransfer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $group='Warehouse Transfer';
    public static $model = 'App\Models\WhTransfer';

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
        'id', 'trackingNumber'
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

            BelongsTo::make('Wh Transfer Location', 'whtransferlocation'),

            Text::make('Tracking Number', 'trackingNumber'),

            Text::make('Courier Name', 'trackingCourier'),


            Date::make('Expect ship in', 'expect_ship_in'),

            Indicator::make('Status', 'status')
            ->labels([
                'DRAFT' => 'Draft',
                'PREPARING' => 'Preparing',
                'TRANSFERRING' => 'Transferring',
                'RECEIVED' => 'Received',
                'CANCELED' => 'Cancel'
            ])
            ->colors([
                'DRAFT' => 'grey',
                'PREPARING' => 'blue',
                'TRANSFERRING' => 'yellow',
                'RECEIVED' => 'green',
                'CANCELED' => 'red'
            ]),


            Date::make('Created Date', 'created_at')
                ->hideWhenUpdating()
                ->hideWhenCreating(),

            Text::make('Created By', 'createdBy')
            ->hideWhenUpdating()
            ->hideWhenCreating(),

//            ItemTransferResourceTool::make('Model'),

            HasMany::make('Wh Transfer Model', 'whtransfermodel'),

            WhTransferItemPackedResourceTool::make('WhTransferModel')
        ];
    }

    public function actions(Request $request)
    {
        return [
            new CreatePackageTransfer,
            new ChangeStatusWhTransfer,
        ];
    }


}
