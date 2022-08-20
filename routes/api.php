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

Route::post('/auth/signup', [AuthController::class, 'postSignup']);
Route::post('/auth/login', [AuthController::class, 'postSignin']);
Route::post('/auth/signout', [AuthController::class, 'getSignout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->namespace('\App\Http\Controllers\Api')->group(function() {
    Route::get('/profile', 'UserController@profile');

    Route::apiResource('posts', 'UserController', [
        'as' => 'api'
    ]);
});


