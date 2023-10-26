<?php

namespace App\Providers;

use Illuminate\Support\Str;
use App\Models\Vendor\Order;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;
use App\Models\PlanSubscription;
// use App\Models\Vendor\Discount;
use Illuminate\Support\Facades\Schema;
use App\Observers\Tenant\OrderObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\PlanSubscriptionObserver;
// use App\Observers\Vendor\DiscountObserver;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;

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
        Scramble::extendOpenApi(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer', 'JWT')
            );
        });
    }
}
