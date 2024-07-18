<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Platform\ExtraController;
use App\Http\Controllers\API\V1\Platform\OrderController;
use App\Http\Controllers\API\V1\Platform\DomainController;
use App\Http\Controllers\API\V1\Platform\PluginController;
use App\Http\Controllers\API\V1\Platform\ProductController;
use App\Http\Controllers\API\V1\Platform\SettingController;
use App\Http\Controllers\API\V1\Platform\Tag\TagController;
use App\Http\Controllers\API\V1\Platform\CustomerController;
use App\Http\Controllers\API\V1\Platform\Auth\AuthController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use App\Http\Controllers\API\V1\Platform\Category\CategoryController;

Route::middleware([
    'locale', InitializeTenancyByDomainOrSubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

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
                Route::get('/active/list', 'getActiveTags');
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
            Route::get('/active/list', 'getActiveCategories');
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
            Route::post('/update/{product}', 'updateProduct');
            Route::delete('/delete/{product}', 'deleteProduct');
        });

    Route::controller(ExtraController::class)
        ->prefix('extras')
        ->group(function () {
            Route::get('/list', 'getExtras');
            Route::post('/create', 'createExtra');
            Route::get('/details/{extra}', 'getExtraDetails');
            Route::post('/update/{extra}', 'updateExtra');
            Route::delete('/delete/{extra}', 'deleteExtra');
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
            Route::get('/live', 'getLiveOrders');
            Route::get('/detail/{order}', 'getOrderDetails');
            Route::put('update-status/{order}', 'updateOrderStatus');
        });

    Route::controller(SettingController::class)
        ->prefix('settings')
        ->group(function () {
            Route::get('/', 'getAllSettings');
            Route::get('/business/info', 'getGeneralSettings');
            Route::get('/delivery', 'getDeliverySettings');
            Route::get('/branding', 'getBrandingSettings');
            Route::get('/business/timing', 'getBusinessTiming');
            Route::get('/localization', 'getLocalizationSettings');
            Route::get('/order', 'getOrderSettings');
            Route::get('/media', 'getMediaSettings');

            Route::put('/business/info', 'updateGeneralSettings');
            Route::put('/delivery', 'updateDeliverySettings');
            Route::put('/order', 'updateOrderSettings');
            Route::put('/localization', 'updateLocalizationSettings');
            Route::post('/media', 'updateMediaSettings');
            Route::put('/business/timing', 'updateBusinessTiming');
        });

    Route::controller(DomainController::class)
        ->prefix('domains')
        ->group(function () {
            Route::get('/list', 'getDomains');
            Route::post('/create', 'createDomain');
            Route::delete('/delete/{domain}', 'deleteDomain');
        });

    Route::controller(PluginController::class)
        ->prefix('plugins')
        ->group(function () {
            Route::get('/list', 'getPlugins');
            Route::post('/update/{plugin_id}', 'updatePlugin');
            Route::get('/settings/{plugin_id}', 'getPluginSettings');
            Route::post('/update/settings/{plugin}', 'updatePluginSettings');
        });
});
