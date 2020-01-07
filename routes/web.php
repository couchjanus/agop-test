<?php

Route::get('/', function () {
    return view('welcome');
})->name('shop');

require 'admin.php';
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')
    // ->middleware('verified')
    ->prefix('home')
	->group(function () {
        Route::get('', 'HomeController@index')
            ->name('home');
        Route::get('info', 'HomeController@info')
            ->name('profile.info');
        Route::put('store', 'HomeController@store')
            ->name('profile.store');
        Route::get('orders', 'HomeController@orders')
            ->name('profile.orders');
});


