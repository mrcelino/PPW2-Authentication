<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GalleryController;

Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::resource('gallery', GalleryController::class);