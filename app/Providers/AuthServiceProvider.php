<?php

namespace App\Providers;


use App\Models\Item;
use App\Models\Model;
use App\Policies\ItemPolicy;
use App\Policies\ModelPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
//        SaleOrderModel::class => SaleOrderModelsPolicy::class

        Item::class => ItemPolicy::class,
        Model::class => ModelPolicy::class,
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
