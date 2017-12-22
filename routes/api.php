<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/shorten/stats/{token}', 'StatController@index')->name('api.stats');
Route::post('/shorten', 'ShorterController@store')->name('api.shorten.store');
Route::get('/shorten', 'ShorterController@index')->name('api.shorten.index');