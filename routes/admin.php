<?php

Route::namespace('Admin')
    ->prefix('admin')
    ->as('admin.')
	->group(function () {

        Route::get('/', function () {
            return view('admin.index');
        })->name('dashboard'); 

        Route::resource('categories', 'CategoryController');
        Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');

        Route::resource('brands', 'BrandController');
        Route::delete('brands/destroy', 'BrandController@massDestroy')->name('brands.massDestroy');

        Route::group(['prefix' => 'products'], function() {
            Route::post('images/upload', 'ProductImageController@upload')->name('products.images.upload');
            Route::get('images/{id}/delete', 'ProductImageController@destroy')->name('products.images.delete');
            Route::delete('destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
            
        });

        Route::resource('products', 'ProductController');
});
