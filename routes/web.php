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

    Route::resource('users', UserController::class);
    // Route::get('/users', [UserController::class, 'index']);
    // Route::get('/users/{id}', [UserController::class, 'view']);
    // Route::get('products/create', [UserController::class, 'create']);
    // Route::post('products', [UserController::class, 'store']);
    // Route::get('products/{id}/edit', [UserController::class, 'edit']);
    // Route::put('products/{id}', [UserController::class, 'update']);
    // Route::delete('products/{id}', [UserController::class, 'destroy']);

    Route::resource('payments', PaymentController::class);
    // Route::get('/payments', [PaymentController::class, 'index']);
    // Route::get('/payments/{id}', [PaymentController::class, 'view']);
    // Route::get('payments/{id}/edit', [PaymentController::class, 'edit']);
    // Route::post('payments/{id}', [PaymentController::class, 'update']);
    Route::resource('payouts', PayoutController::class);
    // Route::get('/payouts', [PayoutController::class, 'index']);
    // Route::get('/payouts/{payout_id}', [PayoutController::class, 'view']);
});