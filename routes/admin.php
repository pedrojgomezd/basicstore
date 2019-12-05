<?php
Route::group(['middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashboardController@index')->name('admin');    
});

Auth::routes(['register' => false]);