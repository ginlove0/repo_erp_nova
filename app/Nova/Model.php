<?php

namespace App\Nova;

use App\Services\Model\ModelService;
use App\Services\Model\ModelServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Ipsupply\ItemQtyBaseCondition\ItemQtyBaseCondition;
use Khalin\Nova\Field\Link;
use Klepak\NovaRouterLink\RouterLink;
use Laravel\Nova\Actions\Actionable;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use AliAwwad\CreateRelationOnResource\BelongsToWithCreate;

class Model extends Resource
{


    const USEDA = "USEDA";

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
        'name',
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
            ->rules('unique:model'),

            BelongsTo::make('Manufactor', 'manufactors')
                ->onlyOnDetail()
                ->searchable()
//                default is the first data
                ->default(1)
                ->prepopulate(),

            BelongsTo::make('Category', "categories")
                ->onlyOnDetail()
                ->searchable()
                ->prepopulate(),



            ItemQtyBaseCondition::make("NOB", "id", function ($data) use($request) {
//                $request->user();

                Log::info( $request->user());
                $qty = $this->modelService->getQtyItemByCond("NOB", $data, 1);
                return $qty[0]->QTY;
            })->onlyOnIndex(),

            ItemQtyBaseCondition::make("NIB", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("NIB", $data, 1);
                return $qty[0]->QTY;
            })->onlyOnIndex(),

            ItemQtyBaseCondition::make(self::USEDA, "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond(self::USEDA, $data, 1);
                return $qty[0]->QTY;
            })->onlyOnIndex(),

            ItemQtyBaseCondition::make("USEDB", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("USEDB", $data, 1);
                return $qty[0]->QTY;
            })->onlyOnIndex(),


            ItemQtyBaseCondition::make("USEDC", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("USEDC", $data, 1);
                return $qty[0]->QTY;
            })->onlyOnIndex(),

            ItemQtyBaseCondition::make("PART", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("PART", $data, 1);
                return $qty[0]->QTY;
            })->onlyOnIndex(),










            ItemQtyBaseCondition::make("NOB", "id", function ($data) use($request) {
//                $request->user();

                Log::info( $request->user());
                $qty = $this->modelService->getQtyItemByCond("NOB", $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex(),

            ItemQtyBaseCondition::make("NIB", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("NIB", $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex(),

            ItemQtyBaseCondition::make(self::USEDA, "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond(self::USEDA, $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex(),

            ItemQtyBaseCondition::make("USEDB", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("USEDB", $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex(),


            ItemQtyBaseCondition::make("USEDC", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("USEDC", $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex(),

            ItemQtyBaseCondition::make("PART", "id", function ($data) {
                $qty = $this->modelService->getQtyItemByCond("PART", $data, 2);
                return $qty[0]->QTY;
            })->onlyOnIndex(),




//            ->readonly(),
            HasMany::make('Item', 'items'),



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
