<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\API\V1\Vendor\CustomerController;
use App\Http\Controllers\API\V1\Vendor\SettingController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Apply Middleware group on routes
Route::middleware([
    'locale', InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Customer Authentication Routes
    Route::controller(CustomerController::class)
        ->prefix('customers')
        ->group(function () {
            Route::post('/register', 'register');
            Route::post('/login', 'login');
        });

    Route::middleware(['auth:customers'])->group(function () {
        Route::controller(CustomerController::class)
        ->prefix('customers')
        ->group(function () {
            Route::get('/get-profile', 'getProfile');
            Route::put('/update-profile', 'updateProfile');
            Route::post('/update-password', 'updatePassword');
            Route::post('/logout', 'logout');
        });

        Route::controller(SettingController::class)
        ->prefix('settings')
        ->group(function () {
            Route::get('/get-restaurant-settings', 'getSettings');
        });
    });
});
