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

Route::view('/','landing')->name('landing');

Route::group(['middleware' => 'auth.customer:customer'], function () {
    Route::get('purchases', 'PurchaseController@index')->name('purchases.index');
    Route::get('purchases/{purchase}', 'PurchaseController@show')->name('purchases.show');
    Route::post('purchases', 'PurchaseController@store')->name('purchases.store');
    Route::delete('purchases/{purchase}', 'PurchaseController@destroy')->name('purchases.destroy');

    Route::post('payments/{purchase}', 'PaymentController@process')->name('payments.process');
    Route::get('payments/response/{purchase}', 'PaymentController@response')->name('payments.response');
});
