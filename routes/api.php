<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'user'], function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
});

Route::middleware('auth:api')->group(function() {
    Route::group(['prefix' => 'user'], function () {
        Route::post('me', [UserController::class, 'me']);
        Route::post('logout', [UserController::class, 'logout']);
        Route::post('refresh', [UserController::class, 'refresh']);
    });
});

Route::middleware('auth:api')->group(function() {
    Route::group(['prefix' => 'products'], function () {
        Route::post('create', [ProductController::class, 'create']);
        Route::delete('delete/{id}', [ProductController::class, 'destroy']);
        Route::get('', [ProductController::class, 'index']);
        Route::get('view/{id}', [ProductController::class, 'show']);
        Route::get('search', [ProductController::class, 'search']);
    });
});
