<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\API\V1\Platform\OrderController;
use App\Http\Controllers\API\V1\Platform\ProductController;
use App\Http\Controllers\API\V1\Platform\SettingController;
use App\Http\Controllers\API\V1\Platform\Tag\TagController;
use App\Http\Controllers\API\V1\Platform\CustomerController;
use App\Http\Controllers\API\V1\Platform\Auth\AuthController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\API\V1\Platform\Category\CategoryController;

Route::middleware([
    'locale', InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::prefix('v1')->group(function () {

        // Platform Users Authentication Routes
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
        Route::controller(CategoryController::class)
            ->prefix('category')
            ->group(function () {
                Route::get('/list', 'getCategories');
                Route::post('/create', 'createCategory');
                Route::get('/details/{category}', 'getCategoryDetails');
                Route::post('/update/{category}', 'updateCategory');
                Route::delete('/delete/{category}', 'deleteCategory');
            });
        
        Route::controller(ProductController::class)
            ->prefix('products')
            ->group(function () {
                Route::get('/list', 'getProducts');
                Route::post('/create', 'createProduct');
                Route::get('/details/{product}', 'getProductDetails');
                Route::delete('/delete/{product}', 'deleteProduct');
            });

        Route::controller(CustomerController::class)
            ->prefix('customers')
            ->group(function () {
                Route::get('/list', 'getCustomers');
            });
        
        Route::controller(OrderController::class)
            ->prefix('orders')
            ->group(function () {
                Route::get('/list', 'getOrders');
                Route::put('update-status/{order}', 'updateOrderStatus');
            });

        Route::controller(SettingController::class)
            ->prefix('settings')
            ->group(function () {
                Route::get('/business/info', 'getGeneralSettings');
                Route::get('/delivery', 'getDeliverySettings');
                Route::get('/branding', 'getBrandingSettings');
            });
    });
});
