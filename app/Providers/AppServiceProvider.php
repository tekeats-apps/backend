<?php

namespace App\Providers;

use App\Models\Vendor\Order;
use App\Models\PlanSubscription;
use Illuminate\Support\Facades\Schema;
use App\Observers\Tenant\OrderObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\PlanSubscriptionObserver;

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
        Schema::defaultStringLength(191);
        Order::observe(OrderObserver::class);
        PlanSubscription::observe(PlanSubscriptionObserver::class);
    }
}
