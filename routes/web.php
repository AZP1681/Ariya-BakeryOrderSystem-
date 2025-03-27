<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController; 
 
Route::get('/', function () { 
    return view('home');  
})->name('home');
 
Route::get('/order', [ProductController::class, 'index'])->name('order');
Route::get('/search', [ProductController::class, 'search'])->name('order.search');
Route::get('/category', [ProductController::class, 'category_select'])->name('order.category'); 
  
Route::get('/about', function () {
    return view('about');      
})->name('about');

Route::get('/contact', function () {
    return view('contact');   
})->name('contact');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity'); 
Route::post('/insert-order', [OrderController::class, 'InsertOrder'])->name('insert.order'); 
  
    