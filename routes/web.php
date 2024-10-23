<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\PaymentController;
use App\Http\Controllers\Auth\PayoutController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(LoginRegisterController::class)->group(function() {
    // Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/', 'home')->name('home');
    Route::post('/logout', 'logout')->name('logout');

    Route::get('/user-activity', [UserController::class, 'userActivity'])->name('user-activity');

    Route::resource('users', UserController::class);

    Route::resource('payments', PaymentController::class);

    Route::resource('payouts', PayoutController::class);

});