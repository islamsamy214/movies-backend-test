<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovieController;
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

    Route::resource('categories', CategoryController::class);
    //end of categories controller

    Route::resource('movies', MovieController::class)->except('show');
    Route::get('movies/rate/{movie}', [MovieController::class, 'rate'])
        ->name('movies.rate');
    //end of movies controller
});//end of authenticated routes
