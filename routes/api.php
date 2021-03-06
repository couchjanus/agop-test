<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', 'ProductController@index');
// Route::get('/category/{id}', 'CategoryController@getById');

Route::get('/category/{id}', 'ProductController@getProductsByCategory');

Route::get('/product/{id}', 'ProductController@getProductById');

// Route::get('/cart', function() {
//     return view('profile.checkout');
// }

Route::post('/cart', 'OrderController@store');
