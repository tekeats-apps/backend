<?php

use App\Http\Controllers\API\V1\Platform\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'locale', InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::prefix('v1')->group(function () {

        // Admin Users Authentication Routes
        Route::controller(AuthController::class)
            ->prefix('auth')
            ->group(function () {
                Route::post('/login', 'login');
            });
        Route::middleware(['auth:platform-api'])->group(function () {
            Route::controller(AuthController::class)
                ->prefix('auth')
                ->group(function () {
                    Route::get('/get-profile', 'getProfile');
                    Route::put('/update-profile', 'updateProfile');
                    Route::post('/update-password', 'updatePassword');
                    Route::post('/update-profile-image', 'updateProfileImage');
                    Route::get('/logout', 'logout');
                });
        });
    });

});

