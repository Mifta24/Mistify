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

// Services
Route::get('/services', [FrontController::class, 'services'])->name('services');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Front Products
Route::get('/products', [FrontController::class, 'products'])->name('products.index');
Route::get('/products/{slug}', [FrontController::class, 'showProduct'])->name('products.show');

// Cart
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

// Checkout
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
});

// Payment
Route::get('/payment/{order}', [PaymentController::class, 'index'])->name('payment.index')->middleware('auth');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process')->middleware('auth');

//  Order
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/orders/{order}/track', [OrderController::class, 'track'])->name('orders.track');
});

require __DIR__ . '/auth.php';
