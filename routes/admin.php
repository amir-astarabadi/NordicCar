<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;


Route::apiResource('products', ProductController::class);
Route::apiResource('customers', CustomerController::class);
