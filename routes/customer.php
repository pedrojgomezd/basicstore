<?php

Route::get('register', 'CustomerAuth\RegisterController@registerForm')->middleware('guest.customer:customer');
Route::post('register', 'CustomerAuth\RegisterController@register')->name('customer.register');

Route::get('login', 'CustomerAuth\LoginController@showLoginForm')->middleware('guest.customer:customer')->name('customer.login');
Route::post('login', 'CustomerAuth\LoginController@login');

Route::post('logout', 'CustomerAuth\LoginController@logout')->name('customer.logout');
