<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;

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
     Route::middleware(['guest'])->group(function () {
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
            Route::get('/',  'index')->name('index');
        });
    });



});
