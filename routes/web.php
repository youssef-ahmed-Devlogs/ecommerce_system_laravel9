<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProductReviewController;
use Illuminate\Support\Facades\Route;


/**
 * Frontend Routes
 */

Route::group(['as' => 'frontend.'], function () {
  Route::get('/', [FrontendController::class, 'index'])->name('index');
  Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
  Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
  Route::get('/detail', [FrontendController::class, 'detail'])->name('detail');
  Route::get('/shop', [FrontendController::class, 'shop'])->name('shop')->middleware(['auth', 'verified']);

  Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    // Products
    Route::get('/{product}', [FrontendController::class, 'show'])->name('show');


    Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], function () {
      Route::middleware(['auth'])->group(function () {
        // Reviews
        Route::post('/{product}/reviews', [ProductReviewController::class, 'store'])->name('store');
        Route::get('/{review}/reviews', [ProductReviewController::class, 'edit'])->name('edit');
        Route::patch('/{review}/reviews', [ProductReviewController::class, 'update'])->name('update');
        Route::delete('/{review}/reviews', [ProductReviewController::class, 'destroy'])->name('destroy');
      });
    });
  });
});
