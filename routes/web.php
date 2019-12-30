<?php

Route::get('/', function () {
    return view('welcome');
})->name('shop');

require 'admin.php';