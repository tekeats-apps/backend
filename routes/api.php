<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Vendor\OrderController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\API\V1\Vendor\SettingController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\API\V1\Vendor\Product\ProductController;
use App\Http\Controllers\API\V1\Vendor\Customer\AddressController;
use App\Http\Controllers\API\V1\Vendor\Product\CategoryController;
use App\Http\Controllers\API\V1\Vendor\Customer\CustomerController;

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
        ->prefix('customer')
        ->group(function () {
            Route::post('/register', 'register');
            Route::post('/login', 'login');

        });

    Route::middleware(['auth:customers'])->group(function () {
        Route::controller(CustomerController::class)
            ->prefix('customer')
            ->group(function () {
                Route::get('/send-verification-email', 'sendVerificationEmail');
                Route::post('/verify-email', 'verifyEmail');

                Route::get('/get-profile', 'getProfile');
                Route::put('/update-profile', 'updateProfile');
                Route::post('/update-password', 'updatePassword');
                Route::post('/update-profile-image', 'updateProfileImage');
                Route::post('/logout', 'logout');

                Route::get('orders', 'getCustomerOrders');
                Route::controller(AddressController::class)
                    ->prefix('address')
                    ->group(function () {
                        Route::post('/store', 'storeAddress');
                        Route::get('/list', 'getCustomerAddresses');
                        Route::put('/update/{id}', 'updateAddress');
                        Route::delete('/delete/{id}', 'deleteAddress');

                        Route::put('/set-default/{id}', 'setDefaultAddress');
                    });
            });

        Route::controller(SettingController::class)
            ->prefix('setting')
            ->group(function () {
                Route::get('/get-restaurant-settings', 'getSettings');
            });

        Route::controller(CategoryController::class)
            ->prefix('category')
            ->group(function () {
                Route::get('/list', 'getList');
            });
            Route::controller(ProductController::class)
            ->prefix('product')
            ->group(function () {
                Route::get('/list', 'getList');
                Route::get('/detail/{productId}', 'getProductDetails');
                Route::get('/category/{categoryId}', 'getProductsByCategory');
            });

        Route::controller(OrderController::class)
            ->prefix('orders')
            ->group(function () {
                Route::get('/order/{orderId}', 'getOrderDetails');
                Route::get('/calculate-delivery-charges', 'calculateDeliveryCharges');
                Route::post('/place-order', 'placeOrder');
            });
    });
});
