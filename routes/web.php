<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatusController;
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

Route::get('/user/home', [HomeController::class,'index'])->middleware('auth')->name('home');

/*Авторизация*/
Route::get('/signup', [AuthController::class,'GetSignUp'])->middleware('guest')->name('auth.signup');
Route::post('/signup', [AuthController::class,'PostSignUp'])->middleware('guest');

Route::get('/signin', [AuthController::class,'GetSignIn'])->middleware('guest')->name('auth.signin');
Route::post('/signin', [AuthController::class,'PostSignIn'])->middleware('guest');

Route::get('/signout', [AuthController::class,'GetSignOut'])->name('auth.signout');

/*Страница друзья*/
Route::get('/friends', [FriendController::class,'GetIndex'])->middleware('auth')->name('friends.index');
Route::get('/friends/add/{username}', [FriendController::class,'GetAdd'])->middleware('auth')->name('friends.add');
Route::get('/friends/accept/{username}', [FriendController::class,'GetAccept'])->middleware('auth')->name('friends.accept');
/*Страница друзья*/
Route::post('/friends/delete/{username}', [FriendController::class,'PostDelete'])->middleware('auth')->name('friends.delete');

/*Страницы пользователей*/
Route::get('/user/{username}', [ProfileController::class,'GetProfile'])->name('profile.index');


/*Страница редактирования*/
Route::get('/profile/edit', [ProfileController::class,'GetEdit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/edit', [ProfileController::class,'PostEdit'])->middleware('auth')->name('profile.edit');

/*Страница поиска*/
Route::get('/search', [SearchController::class,'GetInfo'])->middleware('auth')->name('search.info');

/*Страница my*/
Route::post('/status', [StatusController::class,'StatusPost'])->middleware('auth')->name('status.post');
Route::post('/status/{statusId}/out', [StatusController::class,'PostOut'])->middleware('auth')->name('status.out');
