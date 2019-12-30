<?php

Route::namespace('Admin')
    ->prefix('admin')
    ->as('admin.')
	->group(function () {

        Route::get('/', function () {
            return view('admin.index');
        })->name('dashboard'); 

        Route::resource('categories', 'CategoryController');
        
        Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
        
        Route::resource('products', 'ProductController');
});
