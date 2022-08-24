<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\AuthController;

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

Route::middleware('guest')->group(function() {
    Route::get('/signup', [AuthController::class, 'getSignup'])->name('get.signup');
    Route::post('/auth/signup', [AuthController::class, 'postSignup'])->name('post.signup');

    Route::get('/signin', [AuthController::class, 'getSignin'])->name('get.signin');
    Route::post('/auth/signin', [AuthController::class, 'postSignin'])->name('post.signin');
});

Route::get('/signout', [AuthController::class, 'getSignout'])->name('get.signout');

Route::middleware('auth')->group(function() {
    Route::resource('posts', PostContoller::class)->except([
        'destroy'
    ]);
});
