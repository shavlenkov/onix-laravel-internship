<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->namespace('\App\Http\Controllers')->group(function() {
    Route::get('/signup', 'AuthController@getSignup')->name('get.signup');
    Route::post('/auth/signup', 'AuthController@postSignup')->name('post.signup');

    Route::get('/signin', 'AuthController@getSignin')->name('get.signin');
    Route::post('/auth/signin', 'AuthController@postSignin')->name('post.signin');
});

Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('get.logout');

Route::middleware('auth')->namespace('\App\Http\Controllers')->group(function() {
    Route::get('/profile', 'UserController@profile')->name('profile');
});
