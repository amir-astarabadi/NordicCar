<?php

use App\Http\Controllers\Admin\CustomerOrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;


Route::apiResource('products', ProductController::class)->only(['index', 'store']);
Route::apiResource('customers', CustomerController::class)->only(['show']);
Route::apiResource('customers.orders', CustomerOrderController::class)->only(['index']);
