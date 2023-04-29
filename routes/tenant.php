<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Store\HomeController;
use App\Http\Controllers\Store\RoleController;
use App\Http\Controllers\Store\DashboardController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Store\AuthController as StoreAuthController;
use App\Http\Controllers\Store\UserController as StoreUserController;

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

            // User Routes Group
            Route::controller(StoreUserController::class)
                ->prefix('users')
                ->as('store.users.')
                ->group(function () {
                    Route::get('/', 'index')->name('list');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/create', 'store')->name('store');
                    Route::get('/edit/{user}', 'edit')->name('edit');
                    Route::put('/update/{user}', 'update')->name('update');
                    Route::put('/password/update/{user}', 'passwordUpdate')->name('password.update');
                });

            //Roles Routes Group
            Route::controller(RoleController::class)
                ->prefix('roles')
                ->as('store.roles.')
                ->group(function () {
                    Route::get('/', 'index')->name('list');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/create', 'store')->name('store');
                    Route::get('/edit/{role}', 'edit')->name('edit');
                    Route::put('/update/{role}', 'update')->name('update');

                    Route::get('sync-permissions', 'syncPermissions')->name('sync.permissions');
                    Route::get('role-permissions/{role}', 'rolePermissions')->name('view.permissions');
                    Route::post('sync-role-permissions/{role}', 'syncRolePermissions')->name('update.permissions');
                });

        });



    });

    // Front-end Website Routes Group
    Route::controller(HomeController::class)
        ->group(function () {
            Route::get('/', 'commingSoon')->name('comming.soon');
        });
});
