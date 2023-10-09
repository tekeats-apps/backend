<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PluginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PluginTypeController;
use App\Http\Controllers\Admin\PlanFeatureController;
use App\Http\Controllers\Admin\RestaurantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Coming Soon Page
Route::get('/', function () {
    return view('coming_soon');
});

// Admin Routes
Route::prefix('admin')->group(function () {

    // Auth Routes Group (Guest)
    Route::middleware(['guest:admin'])->group(function () {
        Route::controller(AuthController::class)
            ->as('admin.auth.')
            ->group(function () {
                Route::get('/login',  'index')->name('login');
                Route::post('/login',  'login')->name('action.login');
            });
    });

    // Authenticated Routes
    Route::middleware(['auth:admin'])->group(function () {

        //Admin Auth Routes (Authenticated)
        Route::controller(AuthController::class)
            ->as('admin.auth.')
            ->group(function () {
                Route::post('/logout',  'logout')->name('logout');
            });

        // Dashboard Routes Group
        Route::controller(DashboardController::class)
            ->prefix('dashboard')
            ->as('admin.dashboard.')
            ->group(function () {
                Route::get('/',  'index')->name('index');
            });

        // User Routes Group
        Route::controller(UserController::class)
            ->prefix('users')
            ->as('admin.users.')
            ->group(function () {
                Route::get('/',  'index')->name('list');
                Route::get('/create',  'create')->name('create');
                Route::post('/create',  'store')->name('store');
                Route::get('/edit/{user}',  'edit')->name('edit');
                Route::put('/update/{user}',  'update')->name('update');
                Route::put('/password/update/{user}',  'passwordUpdate')->name('password.update');
            });

        //Roles Routes Group
        Route::controller(RoleController::class)
            ->prefix('roles')
            ->as('admin.roles.')
            ->group(function () {
                Route::get('/',  'index')->name('list');
                Route::get('/create',  'create')->name('create');
                Route::get('/edit/{role}',  'edit')->name('edit');
            });

        //Restaurant Routes Group
        Route::controller(RestaurantController::class)
            ->prefix('restaurants')
            ->as('admin.restaurant.')
            ->group(function () {
                Route::get('/',  'index')->name('list');
            });

        //Orders Routes Group
        Route::controller(OrderController::class)
            ->prefix('orders')
            ->as('admin.order.')
            ->group(function () {
                Route::get('/',  'index')->name('list');
                Route::get('/create',  'create')->name('create');
                Route::post('/create',  'store')->name('store');
            });

        // Plugin Type Routes Group
        Route::controller(PluginTypeController::class)
            ->prefix('plugins/types')
            ->as('admin.plugin.types.')->group(function () {
                Route::get('/', 'index')->name('list');
                Route::get('/create',  'create')->name('create');
                Route::post('/store',  'store')->name('store');
                Route::get('/edit/{id}',  'edit')->name('edit');
                Route::put('/update/{id}', 'update')->name('update');
            });

        // Plugin Routes Group
        Route::controller(PluginController::class)
            ->prefix('plugins')
            ->as('admin.plugins.')->group(function () {
                Route::get('/', 'index')->name('list');
                Route::get('/create',  'create')->name('create');
                Route::post('/store',  'store')->name('store');
                Route::get('/show/{uuid}',  'show')->name('show');
                Route::get('/edit/{uuid}',  'edit')->name('edit');
                Route::put('/update/{uuid}', 'update')->name('update');
            });

        // Plan Feature Routes Group
        Route::controller(PlanFeatureController::class)
            ->prefix('plans/features')
            ->as('admin.plans.features.')->group(function () {
                Route::get('/', 'index')->name('list');
                Route::get('/create',  'create')->name('create');
                Route::post('/store',  'store')->name('store');
                Route::get('/show/{id}',  'show')->name('show');
                Route::get('/edit/{id}',  'edit')->name('edit');
                Route::put('/update/{id}', 'update')->name('update');
            });
    });
});
