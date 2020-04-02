<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\Model;
use App\Models\SaleOrder;
use App\Models\SaleOrderNote;
use App\Observers\ItemObserver;
use App\Observers\ModelObserver;
use App\Observers\SaleOrderNoteObserver;
use App\Observers\SaleOrderObserver;
use DigitalCloud\ModelNotes\Note;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Model::observe(ModelObserver::class);
        Item::observe(ItemObserver::class);
    }
}
