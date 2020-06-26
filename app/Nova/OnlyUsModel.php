<?php

namespace App\Nova;

use App\Nova\Filters\ModelHaveItemFilter;
use App\Nova\Filters\ModelUSHaveItemFilter;
use App\Services\Model\ModelService;
use Illuminate\Http\Request;
use Ipsupply\ItemQtyBaseCondition\ItemQtyBaseCondition;
use Ipsupply\ItemTransferQtyBaseModel\ItemTransferQtyBaseModel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class OnlyUsModel extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */

//    public static $displayInNavigation = false;

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
    public static $model = 'App\Models\OnlyUsModel';


    public static $perPageOptions = [50, 100, 200];

    public static function label(){
        return 'US Model';
    }



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

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make("Name")
                ->hideFromIndex(),

            Text::make("Name", "name", function($value){
                $model = \App\Models\Model::where('name', $value)->first();
                $modelName = str_limit($value, '20', '...');
                return "<a class=\"no-underline font-bold dim text-primary\" href='http://admin.ipsupply.net/nova/resources/models/$model->id'>$modelName</a>";
            })
                ->asHtml()
                ->onlyOnIndex()
                ->sortable(),

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

            ItemTransferQtyBaseModel::make("Incomming US", "id", function ($data){
                $qty = $this->modelService->getQtyItemByTransfer($data, 3);

                return $qty[0]->QTY;
            })->onlyOnIndex()
                ->sortable(),


            ItemQtyBaseCondition::make("US:NIB", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("NIB", $data, 2);
                return $qty[0];
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("US:NOB", "id", function ($data) use ($request) {
                $qty = $this->modelService->getQtyItemByCond("NOB", $data, 2);
                return $qty[0];
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("US:USEA", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond(self::USEA, $data, 2);
                return $qty[0];
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("US:USEB", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("USEB", $data, 2);
                return $qty[0];
            })->onlyOnIndex()
                ->sortable(),


            ItemQtyBaseCondition::make("US:USEC", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("USEC", $data, 2);
                return $qty[0];
            })->onlyOnIndex()
                ->sortable(),

            ItemQtyBaseCondition::make("US:PART", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("PART", $data, 2);
                return $qty[0];
            })->onlyOnIndex()
                ->sortable(),




//            ->readonly(),
            HasMany::make('Item', 'items', 'App\Nova\OnlyUsItem')
        ];
    }

    public function filters(Request $request)
    {
        return[
            new ModelUSHaveItemFilter,
        ];
    }


}
