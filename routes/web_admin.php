<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/**
 * Admin Panel Routes
 */

Route::group(['prefix' => 'admin', 'as' => 'backend.'], function () {

  // Admin Role Start
  Route::middleware(['auth', 'role:admin', 'verified'])->group(function () {
    Route::get('/', [BackendController::class, 'index'])->name('index');

    // Users
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
      Route::get('/', [UserController::class, 'index'])->name('index');
      Route::get('/create', [UserController::class, 'create'])->name('create');
      Route::post('/store', [UserController::class, 'store'])->name('store');
      Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
      Route::post('/{id}/update', [UserController::class, 'update'])->name('update');
      Route::post('/{id}/update-profile-image', [UserController::class, 'updateProfileImage'])->name('updateProfileImage');
      Route::post('/{id}/update-password', [UserController::class, 'updatePassword'])->name('updatePassword');
      Route::post('/{id}/delete', [UserController::class, 'destroy'])->name('destroy');
    });

    // Roles
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
      Route::get('/', [RoleController::class, 'index'])->name('index');
      Route::get('/create', [RoleController::class, 'create'])->name('create');
      Route::post('/store', [RoleController::class, 'store'])->name('store');
      Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
      Route::post('/{id}/update', [RoleController::class, 'update'])->name('update');
      Route::post('/{id}/delete', [RoleController::class, 'destroy'])->name('destroy');
    });

    // Categories
    Route::resource('categories', CategoryController::class);


    // Products Reviews
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
      Route::resource('reviews', ProductReviewController::class);
      Route::post('/reviews/{review}/approved', [ProductReviewController::class, 'approved'])->name('reviews.approved');
      Route::post('/reviews/{review}/hide', [ProductReviewController::class, 'hide'])->name('reviews.hide');
    });

    // Products
    Route::resource('/products', ProductController::class);
    // End Products
  });
  // Admin Role End


  // Guest
  Route::middleware(['guest'])->group(function () {
    Route::get('/login', [BackendController::class, 'login'])->name('login');
    Route::get('/forgot_password', [BackendController::class, 'forgot_password'])->name('forgot_password');
  });
});

Auth::routes(['verify' => true]);
