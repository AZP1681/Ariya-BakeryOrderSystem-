<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController; 

use App\Http\Controllers\AdminController;
  
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
  
// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin_products');
    })->name('admin.index');

    Route::get('/orders', function () {
        return view('admin_order');  // Returns the Blade view
    })->name('admin.orders.view');
 
    // Route for AJAX polling (returns JSON)
    Route::get('/orders/data', [AdminController::class, 'fetch_orders_ajax'])->name('admin.orders.fetch');
});

    