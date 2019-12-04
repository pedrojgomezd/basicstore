<?php

Route::get('register', 'CustomerAuth\RegisterController@registerForm')->middleware('guest:customer')->name('register');
Route::post('register', 'CustomerAuth\RegisterController@register')->name('customer.register');

Route::get('login', 'CustomerAuth\LoginController@showLoginForm')->middleware('guest:customer')->name('customer.login');
Route::post('login', 'CustomerAuth\LoginController@login')->name('login');

Route::post('logout', 'CustomerAuth\LoginController@logout')->name('logout');

Route::get('car', 'CustomerController@car')->name('customer.car');