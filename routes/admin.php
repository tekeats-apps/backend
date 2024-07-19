<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\PluginController;
use App\Http\Controllers\API\V1\Admin\Auth\AuthController;
use App\Http\Controllers\API\V1\Admin\Tenant\TenantController;
use App\Models\Vendor\Role;

// Admin Users Authentication Routes
Route::controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::post('/login', 'login');
    });

Route::middleware(['auth:admin-api'])->group(function () {
    Route::controller(AuthController::class)
        ->prefix('auth')
        ->group(function () {
            Route::get('/get-profile', 'getProfile');
            Route::put('/update-profile', 'updateProfile');
            Route::post('/update-password', 'updatePassword');
            Route::post('/update-profile-image', 'updateProfileImage');
            Route::get('/logout', 'logout');
        });

    Route::controller(TenantController::class)
        ->prefix('restaurants')
        ->group(function () {
            Route::get('/list', 'listTenants');
            Route::get('/details/{tenant}', 'getDetails');
            Route::post('/register', 'registerTenant');
            Route::post('/validate/business', 'checkBusinessName');
            Route::post('/validate/business/domain', 'checkDomain');
        });

    Route::controller(PluginController::class)
        ->prefix('plugins')
        ->group(function () {

            Route::prefix('type')->group(function () {
                Route::get('/list', 'getPluginTypes');
                Route::get('/edit/{id}', 'getPluginType');
                Route::post('/create', 'createPluginType');
                Route::put('/update/{id}', 'updatePluginType');
                Route::delete('/delete/{id}', 'deletePluginType');
            });

            Route::get('/list', 'getPlugins');
            Route::get('/list/active', 'getActivePlugins');
            Route::get('/details/{id}', 'getPluginDetails');
            Route::post('/create', 'createPlugin');
            Route::post('/update/{plugin}', 'updatePlugin');
            Route::delete('/delete/{id}', 'deletePlugin');
            Route::post('/update/settings/form/{plugin}', 'updatePluginSettingsForm');
            Route::get('/settings/form/{plugin}', 'getPluginSettingsForm');
        });
});
