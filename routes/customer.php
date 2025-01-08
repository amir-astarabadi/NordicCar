<?php

use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::post('register', [AuthController::class, 'register'])->name('auth.register');

Route::middleware(['auth:sanctum', 'ability:view-dashboard,place-order'])
    ->group(function () {
        Route::get('dashboard/profile', ProfileController::class)->name('dashboard.show');
        Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
