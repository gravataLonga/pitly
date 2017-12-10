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

Route::get('shorter', 'ShorterController@index')->name('shorter.index');
Route::post('shorter', 'ShorterController@store')->name('shorter.store');

Route::get('s/{token}', 'RedirectController@index')->name('redirect.index');
