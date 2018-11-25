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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/params', 'HomeController@params')->middleware('auth');
Route::post('/determine-speed', 'ContentController@determineSpeed')->middleware('auth');
Route::post('/getContent', 'ContentController@getContent')->middleware('auth');
