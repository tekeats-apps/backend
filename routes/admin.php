<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\Auth\AuthController;

Route::prefix('v1/admin')->group(function () {

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
    });
});
