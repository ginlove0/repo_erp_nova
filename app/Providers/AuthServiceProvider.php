<?php

namespace App\Providers;


use App\Models\Item;
use App\Models\Model;
use App\Models\OnlyUsModel;
use App\Models\SaleOrder;
use App\Models\SaleOrderItem;
use App\Models\Sender;
use App\Policies\ItemPolicy;
use App\Policies\ModelPolicy;
use App\Policies\ModelUSPolicy;
use App\Policies\SaleOrderItemPolicy;
use App\Policies\SaleOrderPolicy;
use App\Policies\SenderPolicy;
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
        Item::class => ItemPolicy::class,
        Model::class => ModelPolicy::class,
        SaleOrder::class => SaleOrderPolicy::class,
        SaleOrderItem::class => SaleOrderItemPolicy::class,
        Sender::class => SenderPolicy::class,
//        OnlyUsModel::class => ModelUSPolicy::class



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
