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

Route::get('/', "PageController@index")->name("pages.home");
Route::get('/videos/filter-by={filter}', "PageController@videos")->name("pages.videos");
Route::get('/video/{video:slug}', "PageController@video")->name("pages.video");
Route::resource('videos', 'VideoController');
Route::resource('categories', 'CategoryController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
