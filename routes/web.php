<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('home');  
})->name('home');
 
Route::get('/order', [ProductController::class, 'index'])->name('order');


Route::get('/about', function () {
    return view('about');  
})->name('about');

Route::get('/contact', function () {
    return view('contact');  
})->name('contact');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart']);
  