<?php

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

Auth::routes();

Route::get('/restaurants/autocomplete/{term}', 'RestaurantsController@autocomplete')->name('autocomplete')->middleware('auth');

Route::resource('restaurants', 'RestaurantsController')->except(['destroy'])->middleware('auth');
Route::get('restaurants/delete/{restaurant}', 'RestaurantsController@delete')->name('restaurants.destroy')->middleware('auth');

Route::resource('reviews', 'ReviewsController')->except(['destroy'])->middleware('auth');
Route::get('reviews/delete/{review}', 'ReviewsController@delete')->name('reviews.destroy')->middleware('auth');