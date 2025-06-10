<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/orders/invoice/{id}', [HomeController::class, 'invoice'])->name('orders.invoice');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::get('/history', [ProductController::class, 'history'])->name('history');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');
Route::patch('/cart/{id}', [ProductController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/{id}', [ProductController::class, 'deleteCart'])->name('cart.delete');
Route::post('/checkout/process', [ProductController::class, 'processCheckout'])->name('checkout.process');
