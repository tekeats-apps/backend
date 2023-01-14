<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\Admin\UserController;

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
Route::middleware(['locale'])->group(function (){
    //    Admin Routes
    Route::prefix('admin')->group(function () {
        Route::controller(UserController::class)
            ->prefix('user')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });
    });
});



