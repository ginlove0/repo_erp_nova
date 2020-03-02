<?php

namespace Ipsupply\CheckoutItemResourceTool;

use App\Services\SaleOrder\SaleOrderService;
use App\Services\SaleOrder\SaleOrderServiceInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('checkout-item-resource-tool', __DIR__.'/../dist/js/tool.js');
            Nova::style('checkout-item-resource-tool', __DIR__.'/../dist/css/tool.css');
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
                ->prefix('nova-vendor/checkout-item-resource-tool')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        //Register Sale Model Service
        $this->app->singleton(SaleOrderServiceInterface::class, function ($app) {
            return new SaleOrderService();
        });
    }
}
