<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Contact
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');

// About
Route::get('/about', [FrontController::class, 'about'])->name('about');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Front Products
Route::get('/products', [FrontController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [FrontController::class, 'show'])->name('products.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process')->middleware('auth');


// Payment
Route::get('/payment/{order}', [PaymentController::class, 'index'])->name('payment.index')->middleware('auth');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process')->middleware('auth');

// Riwayat Order
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');

require __DIR__ . '/auth.php';
