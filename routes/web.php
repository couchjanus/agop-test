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
        Route::get('order/{order}', 'OrderController@show')
            ->name('profile.order');
});


Route::get('/order', function () {
    $invoice = App\Order::find(1);
    
    // return (new App\Mail\OrderShipped($invoice))->render();
    return new App\Mail\OrderShipped($invoice);
});

Route::get('ship', 
   ['as' => 'order.index', 'uses' => 'OrderController@index']);
Route::post('ship/{id}', 
   ['as' => 'order.ship', 'uses' => 'OrderController@ship']);

