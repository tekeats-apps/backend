<?php

namespace App\Providers;

use Illuminate\Support\Str;
use App\Models\Vendor\Order;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;
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
        Scramble::routes(function (Route $route) {
            return Str::startsWith($route->uri, 'api/');
        });
    }
}
