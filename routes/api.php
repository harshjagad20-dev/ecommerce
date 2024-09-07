<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Register user
//--------------------
Route::post('register', [AuthController::class, 'register']);

// Get products
//--------------------
Route::get('products', ProductController::class);

Route::group(['prefix' => 'auth'], function () {
    // login
    //--------------------
    Route::post('login', [AuthController::class, 'login']);

    // logout
    //--------------------
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    // Add cart
    //--------------------
    Route::post('add-cart/{product}', [CartController::class, 'addToCart']);
    
    // Update cart
    //--------------------
    Route::post('update-cart/{product}', [CartController::class, 'updateCart']);

    // Checkout
    //--------------------
    Route::post('checkout', [CartController::class, 'checkout']);
});