<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/make-me-admin', function () {
    $user = \App\Models\User::updateOrCreate(
        ['email' => 'admin@myshop.com'],
        [
            'name' => 'Admin',
            'password' => \Hash::make('password123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]
    );
    return 'Admin created. Email: admin@myshop.com / Password: password123';
});



Route::get('/home', function () {
    $bestSale = \App\Models\Product::orderByDesc('id')->take(4)->get();
    return view('home', compact('bestSale'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// IMPORTANT: search route must come BEFORE the products resource route
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// short cut the crud
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('/cart/data', [CartController::class, 'data'])->name('cart.data');
});

// public browsing routes
Route::get('/category/{category}', [ProductController::class, 'byCategory'])->name('products.byCategory');

// protected — rating, cart, checkout
Route::middleware('auth')->group(function () {
    Route::post('/product/{product}/rate', [RatingController::class, 'store'])->name('products.rate');
    Route::get('/admin/charts', [OrderController::class, 'charts'])->name('orders.charts');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::middleware('auth')->group(function () {
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('orders.admin');
    Route::get('/admin/charts', [OrderController::class, 'charts'])->name('orders.charts');
    Route::get('/cart/data', [CartController::class, 'data'])->name('cart.data');
});


Route::get('/whoami', function () {
    if (!auth()->check()) return 'not logged in';
    return [
        'email' => auth()->user()->email,
        'role'  => auth()->user()->role,
    ];
});


require __DIR__.'/auth.php';