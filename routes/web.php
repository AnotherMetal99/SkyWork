<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class,'index'])->name('home');

/*Авторизация*/
Route::get('/signup', [AuthController::class,'GetSignUp'])->middleware('guest')->name('auth.signup');
Route::post('/signup', [AuthController::class,'PostSignUp'])->middleware('guest');

Route::get('/signin', [AuthController::class,'GetSignIn'])->middleware('guest')->name('auth.signin');
Route::post('/signin', [AuthController::class,'PostSignIn'])->middleware('guest');

Route::get('/signout', [AuthController::class,'GetSignOut'])->name('auth.signout');

/*Страницы пользователей*/
Route::get('/user/{username}', [ProfileController::class,'GetProfile'])->name('profile.index');

/*Страницы пользователей*/
Route::get('/profile/edit', [ProfileController::class,'GetEdit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/edit', [ProfileController::class,'PostEdit'])->middleware('auth')->name('profile.edit');
