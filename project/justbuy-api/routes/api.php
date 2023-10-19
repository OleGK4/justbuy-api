<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Authentication
Route::prefix('auth')->group(function () {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// Store interaction
Route::prefix('store')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('cart/{product_id}', [CartController::class, 'store']);
        Route::delete('cart/{product_id}', [CartController::class, 'destroy']);
        Route::apiResource('cart', CartController::class);
        Route::apiResource('order', OrderController::class);
    });
});

// Admin panel
Route::prefix('admin')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::middleware('isAdmin')->group(function(){
            Route::delete('products/{product_id}', [ProductController::class, 'destroy']);
            Route::apiResource('products', ProductController::class);
        });
    });
});
