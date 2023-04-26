<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Store\AuthController as StoreAuthController;
use App\Http\Controllers\Store\HomeController;
use App\Http\Controllers\Store\DashboardController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::prefix('store')->group(function () {

        // Auth Routes Group (Guest)
        Route::middleware(['guest:store'])->group(function () {
            Route::controller(StoreAuthController::class)
                ->as('store.auth.')
                ->group(function () {
                    Route::get('/login', 'index')->name('login');
                    Route::post('/login', 'login')->name('action.login');
                });
        });

        // Authenticated Routes
        Route::middleware(['auth:store'])->group(function () {

            //Admin Auth Routes (Authenticated)
            Route::controller(StoreAuthController::class)
                ->as('store.auth.')
                ->group(function () {
                    Route::post('/logout', 'logout')->name('logout');
                });

            // Store Dashboard Routes Group
            Route::controller(DashboardController::class)
                ->prefix('dashboard')
                ->as('store.dashboard.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                });


        });



    });

    // Front-end Website Routes Group
    Route::controller(HomeController::class)
        ->group(function () {
            Route::get('/', 'commingSoon')->name('comming.soon');
        });
});
