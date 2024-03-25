<?php

use App\Http\Controllers\API\V1\Platform\Auth\AuthController;
use App\Http\Controllers\API\V1\Platform\Category\CategoryController;
use App\Http\Controllers\API\V1\Platform\Tag\TagController;
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
            Route::controller(TagController::class)
                ->prefix('tags')
                ->group(function () {
                    Route::get('/list', 'getTags');
                    Route::post('/create-tag', 'createTag');
                    Route::get('/details/{tag}', 'getTagDetails');
                    Route::post('/update/{tag}', 'updateTag');
                    Route::delete('/delete/{tag}', 'deleteTag');
                });
        });
        Route::middleware(['auth:platform-api'])->group(function () {
            Route::controller(CategoryController::class)
                ->prefix('category')
                ->group(function () {
                    Route::get('/list', 'getCategories');
                    Route::post('/create', 'createCategory');
                    Route::get('/details/{category}', 'getCategoryDetails');
                    Route::post('/update/{category}', 'updateCategory');
                    Route::delete('/delete/{category}', 'deleteCategory');
                });
        });
    });

});

