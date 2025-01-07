<?php

use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::post('register', [AuthController::class, 'register'])->name('auth.register');