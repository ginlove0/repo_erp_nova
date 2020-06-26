<?php

namespace App\Nova;

use App\Nova\Actions\ChangeStatusWhTransfer;
use App\Nova\Actions\CreatePackageTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inspheric\Fields\Indicator;
use Ipsupply\ItemTransferResourceTool\ItemTransferResourceTool;
use Ipsupply\WhTransferItemPackedResourceTool\WhTransferItemPackedResourceTool;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaNotesField\NotesField;

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
    public static $title = 'trackingNumber';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'transfer_pack', 'trackingNumber'
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

            BelongsTo::make('Wh Transfer Location', 'whtransferlocation'),

            Text::make('Pack', 'transfer_pack')
                ->creationRules('required', 'string'),

            Text::make('Tracking Number','trackingNumber')
                ->help(
                    "<a class='font-bold dim text-primary' style='color: red'> Can not display if missing courier name. Please attention!!!</a>"
                )
            ->hideFromDetail()
            ->hideFromIndex(),

            Text::make('Tracking Number', function($value){

                switch ($value -> trackingNumber)
                {
                    case $value->trackingCourier === 'UPS':
                        return "<a class=\"no-underline font-bold dim text-primary\" target=\"_blank\" href='https://www.ups.com/track?loc=en_AU&tracknum=$value->trackingNumber%250D%250A&requester=WT/trackdetails'>$value->trackingNumber</a>";

                    case $value-> trackingCourier === 'TNT':
                        return "<a class=\"no-underline font-bold dim text-primary\" target=\"_blank\" href='https://www.tnt.com/express/en_au/site/shipping-tools/tracking.html?searchType=con&cons=$value->trackingNumber'>$value->trackingNumber</a>";

                    case $value-> trackingCourier === 'FedEx':
                        return "<a class=\"no-underline font-bold dim text-primary\" target=\"_blank\" href='https://www.fedex.com/apps/fedextrack/index.html?tracknumbers=$value->trackingNumber&cntry_code=au'>$value->trackingNumber</a>";

                    case $value-> trackingCourier === 'Sendle':
                        return "<a class=\"no-underline font-bold dim text-primary\" target=\"_blank\" href='https://track.sendle.com/tracking?ref=$value->trackingNumber'>$value->trackingNumber</a>";

                    case $value-> trackingCourier === 'CourierPlease':
                        return $value -> trackingNumber;

                    default:
                        return '';

                }

            })
            ->asHtml()
            ->hideWhenCreating()
            ->hideWhenUpdating(),

            Text::make('Courier Name', 'trackingCourier')
                ->help(
                    "<a class='font-bold dim text-primary' style='color: red'>Make sure courier name exact same UPS, TNT, Sendle, FedEx or CourierPlease. Otherwise, tracking number can not display</a>"
                ),

            Date::make('Expect ship in', 'expect_ship_in')
            ->hideFromIndex()
            ->hideFromDetail(),

            Date::make('Expect ship in', 'expect_ship_in', function ($value) {
                if($value){
                    return $value -> format('d/m/Y');
                }
                return null;
            })->hideWhenCreating()
            ->hideWhenUpdating(),

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
            ])
            ->sortable(),


            Date::make('Created Date', 'created_at', function ($value) {
                if($value){
                    return $value -> format('d/m/Y');
                }
                return null;
            })
                ->hideWhenUpdating()
                ->hideWhenCreating(),

            Text::make('Updated By', 'createdBy')
            ->hideWhenUpdating()
            ->hideWhenCreating(),

            NotesField::make('Notes')
                ->placeholder('Add Note')
                ->onlyOnDetail(),

            ItemTransferResourceTool::make('Model'),

//            HasMany::make('Wh Transfer Model', 'whtransfermodel'),

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
