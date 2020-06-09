<?php

namespace App\Nova;

use App\Nova\Filters\ModelHaveItemFilter;
use App\Services\Model\ModelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ipsupply\ItemQtyBaseCondition\ItemQtyBaseCondition;
use Ipsupply\ItemTransferQtyBaseModel\ItemTransferQtyBaseModel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Model extends Resource
{


    const USEA = "USEA";

    private $modelService;

    public function __construct(
//        ModelServiceInterface $modelService,
        $resource)
    {
        parent::__construct($resource);

        $this->modelService = new ModelService();
    }

    public static $group = "Product";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Model';

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
        'name', 'shortDescription'
    ];

    public static $perPageOptions = [50, 100, 200];




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


//            Text::make("Name", function($data){
////                Log::info($data);
//                $items = \App\Models\Item::where('modelId', $data -> id)->get();
////                Log::info($items);
//                foreach ($items as $item){
//                    if($item -> stockStatus == 1){
//                        return $data -> name;
//                    }
//                }
//                return $data -> name;
//            })
//                ->rules('unique:model'),
            Text::make("Name")
            ->hideFromIndex()
            ->hideFromDetail(),

            Text::make("Name", function($value){
                return "<a class=\"no-underline font-bold dim text-primary\" href='http://admin.ipsupply.net/nova/resources/models/$value->id'>$value->name</a>";
            })
                ->asHtml()
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->displayUsing(function ($value) {
                    return str_limit($value, '20', '...');
                }),

            Text::make("BB", "name", function($value){
                return "<a class=\"no-underline font-bold dim text-primary\" target=\"_blank\" href='https://members.brokerbin.com/?loc=partkey&parts=$value'>BB</a>";
            })
            ->asHtml()
            ->onlyOnIndex(),

            Text::make("Ebay", "name", function($value){
                return "<a class=\"no-underline font-bold dim text-primary\" target=\"_blank\" href='https://www.ebay.com/sch/i.html?_nkw=$value&_sop=15'>Ebay</a>";
            })
                ->asHtml()
                ->onlyOnIndex(),


            Select::make('Has Serial', 'hasSerial')
                ->options([
                    '1' => 'Has Serial',
                    '0' => 'Non Serial'
                ])
                ->hideFromIndex(),

            BelongsTo::make('Manufactor', 'manufactors')
                ->nullable()
                ->searchable(),

            BelongsTo::make('Category', "categories")
                ->nullable()
                ->searchable()
                ->hideFromIndex(),

            Text::make('Short Description', 'shortDescription')
            -> hideFromIndex(),

            Textarea::make('Long Description', 'longDescription')
            ->hideFromIndex(),


            HasMany::make( 'OtherModelNames')
                ->hideFromIndex(),

            ItemTransferQtyBaseModel::make("2 AU", "id", function ($data){
                $qty = $this->modelService->getQtyItemByTransfer($data, 4);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),


            ItemQtyBaseCondition::make("AU:NIB", "id", function ($data) {


                $qty = $this->modelService->getQtyItemByCond("NIB", $data, 1);
//                if($qty[0]->QTY <= 0)
//                    return $qty[0]->QTY = null;
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("AU:NOB", "id", function ($data) use ($request) {
                $qty = $this->modelService->getQtyItemByCond("NOB", $data, 1);

                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("AU:USEA", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond(self::USEA, $data, 1);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("AU:USEB", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("USEB", $data, 1);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),


            ItemQtyBaseCondition::make("AU:USEC", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("USEC", $data, 1);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("AU:PART", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("PART", $data, 1);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),






            ItemTransferQtyBaseModel::make("2 US", "id", function ($data){
                $qty = $this->modelService->getQtyItemByTransfer($data, 3);

                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),


            ItemQtyBaseCondition::make("US:NIB", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("NIB", $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("US:NOB", "id", function ($data) use ($request) {
                $qty = $this->modelService->getQtyItemByCond("NOB", $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("US:USEA", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond(self::USEA, $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("US:USEB", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("USEB", $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),


            ItemQtyBaseCondition::make("US:USEC", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("USEC", $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("US:PART", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("PART", $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),




//            ->readonly(),
            HasMany::make('Item', 'items')


        ];
    }

    public function filters(Request $request)
    {
        return[
            new ModelHaveItemFilter,
        ];
    }


}
