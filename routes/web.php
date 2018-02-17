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

Route::get('/', 'HomeController@index')->name('home');

Route::get('shorter', 'ShorterController@index')->name('shorter.index');
Route::post('shorter', 'ShorterController@store')->name('shorter.store');
Route::get('s/{token}', 'RedirectController@index')->name('redirect.index');

Route::get('/plans', 'PlanController@index')->name('plan.index');
Route::post('/purchase/{plan}', 'PurchaseController@store')->name('purchase.store');

Route::post(
    'stripe/webhook',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);
Auth::routes();
