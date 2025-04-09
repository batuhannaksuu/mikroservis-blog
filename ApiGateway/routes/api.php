<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GatewayController;

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


    Route::get('posts', [GatewayController::class, 'getPosts']);
    Route::middleware('auth:api')->group(function () {
        Route::post('posts', [GatewayController::class, 'createPost']);
        Route::get('users',[GatewayController::class, 'getUsers']);
    });
    Route::post('register',[\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('login',[\App\Http\Controllers\AuthController::class, 'login']);
