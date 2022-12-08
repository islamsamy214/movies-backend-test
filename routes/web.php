<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
//end of auth dirs

Route::get('/', [DashboardController::class, 'welcome'])
    ->name('welcome');
//end of web routes

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    //end of dashboard routes

    Route::resource('users', UserController::class);
    //end of users routes
});//end of authenticated routes
