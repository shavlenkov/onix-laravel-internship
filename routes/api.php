<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function() {
    Route::post('/signup', [AuthController::class, 'postSignup']);
    Route::post('/signin', [AuthController::class, 'postSignin']);
    Route::post('/signout', [AuthController::class, 'getSignout'])->middleware('auth:sanctum');
});

Route::get('/posts/search', [PostController::class, 'search']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/profile', [UserController::class, 'profile']);

    Route::apiResource('users', UserController::class)->only([
        'index', 'show', 'update', 'destroy'
    ]);

    Route::apiResource('/posts/my', PostController::class, [
        'as' => 'api'
    ]);
});


