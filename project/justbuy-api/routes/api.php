<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    Route::post('/register', [AuthController::class, 'store']);
    Route::post('/login', [AuthController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// Store interaction
Route::prefix('store')->group(function (){
    Route::get('/products', [ProductController::class, 'index']);
    Route::middleware('auth:sanctum')->group(function(){
        Route::apiResource('cart', CartController::class);
        Route::apiResource('orders', OrderController::class);
    });
});

// Admin panel
Route::prefix('admin')->group(function(){
    Route::middleware('auth:sanctum')->group(function(){
        Route::apiResource('products', ProductController::class)
            ->middleware('isAdmin');
    });
});
