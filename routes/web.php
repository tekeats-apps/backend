<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
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

    // Dashboard Routes Group
    Route::controller(DashboardController::class)
        ->prefix('dashboard')
        ->as('admin.dashboard.')
        ->group(function () {
            Route::get('/',  'index')->name('index');
        });

    // Auth Routes Group
    Route::controller(AuthController::class)
        ->as('admin.auth')
        ->group(function () {
            Route::get('/login',  'login')->name('login');
        });
});
