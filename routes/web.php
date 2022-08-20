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

Route::get('/locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
})->name('locale');


Route::middleware('guest')->namespace('\App\Http\Controllers\Web')->group(function() {
    Route::get('/signup', 'AuthController@getSignup')->name('get.signup');
    Route::post('/auth/signup', 'AuthController@postSignup')->name('post.signup');

    Route::get('/signin', 'AuthController@getSignin')->name('get.signin');
    Route::post('/auth/signin', 'AuthController@postSignin')->name('post.signin');
});

Route::get('/signout', 'App\Http\Controllers\Web\AuthController@getSignout')->name('get.signout');

Route::middleware('auth')->namespace('\App\Http\Controllers\Web')->group(function() {
    Route::resource('posts', 'PostController')->except([
        'destroy'
    ]);
});
