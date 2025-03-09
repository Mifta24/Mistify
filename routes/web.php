<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home & Dashboard
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Static Pages
Route::controller(FrontController::class)->group(function () {
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/services', 'services')->name('services');
});

// Products
Route::controller(FrontController::class)->group(function () {
    Route::get('/products', 'products')->name('products.index');
    Route::get('/products/{slug}', 'showProduct')->name('products.show');
});

// Shopping Cart
Route::controller(CartController::class)
    ->prefix('cart')
    ->name('cart.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add/{id}', 'store')->name('store');
        Route::patch('/update/{id}', 'update')->name('update');
        Route::delete('/remove/{id}', 'destroy')->name('destroy');
    });

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // User Profile
    Route::controller(ProfileController::class)
        ->prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('/', 'edit')->name('edit');
            Route::patch('/', 'update')->name('update');
            Route::delete('/', 'destroy')->name('destroy');
        });

    // Checkout Process
    Route::controller(CheckoutController::class)
        ->prefix('checkout')
        ->name('checkout.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/process', 'process')->name('process');
        });

    // Payment Process
    Route::middleware(['auth'])->group(function () {
        // Payment Routes
        Route::controller(PaymentController::class)->group(function () {
            Route::get('/payment/{order}', 'index')->name('payment.index');
            Route::post('/payment/{order}/process', 'process')->name('payment.process');
            Route::get('/payment/{order}/instructions', 'instructions')->name('payment.instructions');
        });
    });

    // Order Management
    Route::controller(OrderController::class)
        ->prefix('orders')
        ->name('orders.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{order}', 'show')->name('show');
            Route::post('/{order}/cancel', 'cancel')->name('cancel');
            Route::get('/{order}/track', 'track')->name('track');
            Route::get('/{order}/print', 'print')->name('print')->middleware('admin');
        });
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
