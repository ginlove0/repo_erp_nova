<?php

namespace App\Providers;


use App\Models\Item;
use App\Models\SaleOrderModels;
use App\Models\SaleOrderModelType;
use App\Models\SaleOrderNote;
use App\Policies\ItemPolicy;
use App\Policies\SaleOrderModelsPolicy;
use App\Policies\SaleOrderModelTypePolicy;
use App\Policies\SaleOrderNotePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
//        SaleOrderModels::class => SaleOrderModelsPolicy::class

//        Item::class => ItemPolicy::class,
//        SaleOrderModelType::class => SaleOrderModelTypePolicy::class


    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
