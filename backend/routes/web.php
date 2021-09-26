<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopPageController;

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

Route::get('/', 'App\Http\Controllers\TopPageController@show');

Route::group(['middleware' => ['auth', 'can:isAdmin']], function () {
    Route::resource('shops', 'App\Http\Controllers\ShopsController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
});

Route::get('shops/visited', 'App\Http\Controllers\ShopsController@visitedShopIndex')->name('visited.index');

Route::post('shops/select-area', 'App\Http\Controllers\ShopsController@index')->name('selected.index');

Route::resource('shops', 'App\Http\Controllers\ShopsController', ['only' => ['index', 'show']]);

Route::resource('shops.review', 'App\Http\Controllers\ReviewsController');

Route::resource('shops.review.nice', 'App\Http\Controllers\NicesController', ['only' => ['store', 'destroy']]); 

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('users', 'App\Http\Controllers\UsersController', ['only' => ['index', 'show']]);
});

Route::group(['middleware' => ['login_user_check']], function() {
    Route::resource('mypage', 'App\Http\Controllers\MypagesController', ['only' => ['show', 'edit', 'update']]); 
    Route::resource('mypage.visit', 'App\Http\Controllers\VisitsController', ['only' => ['index']]); 
    Route::resource('mypage.like', 'App\Http\Controllers\LikesController', ['only' => ['index']]); 
    Route::resource('mypage.history', 'App\Http\Controllers\HistoriesController', ['only' => ['index']]); 
});

Route::resource('shops.visit', 'App\Http\Controllers\VisitsController', ['only' => ['store', 'destroy']]); 

Route::resource('shops.like', 'App\Http\Controllers\LikesController', ['only' => ['store', 'destroy']]); 

Route::resource('users.follow', 'App\Http\Controllers\FollowsController', ['only' => ['index', 'store', 'destroy']]);

Route::get('users/{user}/follower/', 'App\Http\Controllers\FollowsController@followersIndex')->name('followers.index');

Route::resource('review.photo', 'App\Http\Controllers\PhotosController', ['only' => ['store', 'destroy']]);

Route::resource('shops.image', 'App\Http\Controllers\ImagesController', ['only' => ['store', 'destroy']]);