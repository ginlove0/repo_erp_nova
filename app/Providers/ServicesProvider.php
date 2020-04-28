<?php


namespace App\Providers;


use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Condition\ConditionService;
use App\Services\Condition\ConditionServiceInterface;
use App\Services\Item\ItemService;
use App\Services\Item\ItemServiceInterface;
use App\Services\Manufacture\ManufactureService;
use App\Services\Manufacture\ManufactureServiceInterface;
use App\Services\Model\ModelService;
use App\Services\Model\ModelServiceInterface;
use App\Services\SaleOrder\SaleOrderService;
use App\Services\SaleOrder\SaleOrderServiceInterface;
use App\Services\WhTransfer\WhTransferService;
use App\Services\WhTransfer\WhTransferServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->modelService();
        $this->manufactureService();
        $this->categoryService();
        $this->itemService();
        $this->saleOrderService();
        $this->conditionService();
        $this->whTransferService();
    }

    public function modelService()
    {
        $this->app->bind(
            ModelServiceInterface::class,
            ModelService::class
        );
    }


    public function manufactureService()
    {
        $this->app->bind(
            ManufactureServiceInterface::class,
            ManufactureService::class
        );
    }


    public function categoryService()
    {
        $this->app->bind(
            CategoryServiceInterface::class,
            CategoryService::class
        );
    }

    public function itemService()
    {
        $this->app->bind(
            ItemServiceInterface::class,
            ItemService::class
        );
    }


    public function saleOrderService()
    {
        $this->app->bind(
            SaleOrderServiceInterface::class,
            SaleOrderService::class
        );
    }

    public function conditionService()
    {
        $this->app->bind(
            ConditionServiceInterface::class,
            ConditionService::class
        );
    }

    public function whTransferService()
    {
        $this->app->bind(
            WhTransferServiceInterface::class,
            WhTransferService::class
        );
    }
}
