<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\TagController;
use App\Http\Controllers\Vendor\HomeController;
use App\Http\Controllers\Vendor\RoleController;
use App\Http\Controllers\QuickSettingController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\SettingController;
use App\Http\Controllers\Vendor\CategoryController;
use App\Http\Controllers\Vendor\CustomerController;
use App\Http\Controllers\Vendor\DashboardController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Vendor\AuthController as StoreAuthController;
use App\Http\Controllers\Vendor\CouponController;
use App\Http\Controllers\Vendor\TaxController;
use App\Http\Controllers\Vendor\DiscountController;
use App\Http\Controllers\Vendor\UserController as StoreUserController;

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
    Route::post('dropify/remove/image', [QuickSettingController::class, 'removeDropifyImage'])->name('dropify.remove.image');
    Route::prefix('vendor')->group(function () {

        // Auth Routes Group (Guest)
        Route::middleware(['guest:vendor'])->group(function () {
            Route::controller(StoreAuthController::class)
                ->as('vendor.auth.')
                ->group(function () {
                    Route::get('/login', 'index')->name('login');
                    Route::post('/login', 'login')->name('action.login');
                    Route::get('/forget-password', 'forgetPassword')->name('forget.password');
                    Route::post('/forget-password', 'sendForgotPasswordEmail')->name('action.forget.password');
                    Route::get('/reset-password/{token}', 'showResetPasswordForm')->name('reset.password');
                    Route::post('/reset-password', 'resetPassword')->name('reset.password.post');
                });
        });

        // Authenticated Routes
        Route::middleware(['auth:vendor'])->group(function () {

            //Admin Auth Routes (Authenticated)
            Route::controller(StoreAuthController::class)
                ->as('vendor.auth.')
                ->group(function () {
                    Route::post('/logout', 'logout')->name('logout');
                });

            // Store Dashboard Routes Group
            Route::controller(DashboardController::class)
                ->prefix('dashboard')
                ->as('vendor.dashboard.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                });

            // User Routes Group
            Route::controller(StoreUserController::class)
                ->prefix('users')
                ->as('vendor.users.')
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
                ->as('vendor.roles.')
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


            // Categories Routes Group
            Route::controller(CategoryController::class)
                ->prefix('categories')
                ->as('vendor.categories.')
                ->group(function () {
                    Route::get('/', 'index')->name('list');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{category}', 'edit')->name('edit');
                    Route::put('/update/{category}', 'update')->name('update');

                    Route::get('/subcategories/{category}', 'getSubcaegories')->name('subcategories.list');
                    Route::get('/subcategory/create/{category}', 'subcategoryCreate')->name('subcategory.create');
                    Route::post('/subcategory/store', 'store')->name('subcategory.store');
                    Route::get('/subcategory/edit/{category}/{subcategory}', 'subcategoryEdit')->name('subcategory.edit');
                    Route::put('/subcategory/update/{category}', 'update')->name('subcategory.update');
                });

            // Products Routes Group
            Route::controller(ProductController::class)
                ->prefix('products')
                ->as('vendor.products.')
                ->group(function () {
                    Route::get('/', 'index')->name('list');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{product}', 'edit')->name('edit');
                    Route::put('/update/{product}', 'update')->name('update');
                });

            //Tags Routes Group
            Route::controller(TagController::class)
                ->prefix('tags')
                ->as('vendor.tags.')
                ->group(function () {
                    Route::get('/', 'index')->name('list');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{tag}', 'edit')->name('edit');
                    Route::put('/update/{tag}', 'update')->name('update');
                });

            // Settings Routes Group
            Route::controller(SettingController::class)
                ->prefix('settings')
                ->as('vendor.settings.')
                ->group(function () {
                    Route::get('/system-settings', 'systemSettings')->name('system');
                    Route::get('/opening/hours', 'openingHours')->name('opening.hours');
                    Route::post('/opening/hours/store', 'saveOpeningHours')->name('store.opening.hours');
                    Route::post('/update/media', 'updateMedia')->name('update.media');
                });

            // Customers Routes Group
            Route::controller(CustomerController::class)
                ->prefix('customers')
                ->as('vendor.customers.')
                ->group(function () {
                    Route::get('/', 'index')->name('list');
                    Route::get('/edit/{user}', 'edit')->name('edit');
                    Route::put('/update/{user}', 'update')->name('update');
                    Route::put('/password/update/{user}', 'passwordUpdate')->name('password.update');
                });

            //Orders Routes Group
            Route::controller(OrderController::class)
                ->prefix('orders')
                ->as('vendor.order.')
                ->group(function () {
                    Route::get('/',  'index')->name('list');
                });

            // Coupon Routes Group
            Route::controller(CouponController::class)
                ->prefix('coupons')
                ->as('vendor.coupons.')->group(function () {
                    Route::get('/', 'index')->name('list');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/show/{id}', 'show')->name('show');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::put('/update/{id}', 'update')->name('update');
                });

            // Tax Routes Group
            Route::controller(TaxController::class)
                ->prefix('taxes')
                ->as('vendor.taxes.')->group(function () {
                    Route::get('/', 'index')->name('list');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/show/{id}', 'show')->name('show');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::put('/update/{id}', 'update')->name('update');
                });

            // Discount Routes Group
            Route::controller(DiscountController::class)
                ->prefix('discounts')
                ->as('vendor.discounts.')->group(function () {
                    Route::get('/', 'index')->name('list');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/show/{id}', 'show')->name('show');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::put('/update/{id}', 'update')->name('update');
                });
        });
    });

    // Front-end Website Routes Group
    Route::controller(HomeController::class)
        ->group(function () {
            Route::get('/', 'commingSoon')->name('comming.soon');
        });
});
