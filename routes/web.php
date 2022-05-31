<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

Auth::routes();
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::get('/product/detail/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/save', [App\Http\Controllers\ProfileController::class, 'save'])->name('profile.save');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('/category/add', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.add');
        Route::get('/product/add', [App\Http\Controllers\ProductController::class, 'create'])->name('product.add');
        Route::post('/product/add', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
        Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
        Route::post('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'update'])
            ->name('product.update');
        Route::post('/product/delete', [App\Http\Controllers\ProductController::class, 'destroy'])
            ->name('product.destroy');
        Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
        Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
        Route::get('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/cart/checkout', [App\Http\Controllers\CartController::class, 'doCheckout'])
            ->name('cart.doCheckout');
        Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'store'])->name('cart.add');
        Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
        Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions');
    });
});
