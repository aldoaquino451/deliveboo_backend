<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// ADMIN
Route::middleware(['auth', 'verified'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {
    // rotte CRUD
    Route::resource('/', RestaurantController::class);
    Route::resource('products', ProductController::class);
    // rotte custom
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('products/{product}', [ProductController::class, 'productToDelete'])->name('products-new');
  });


// PUBLIC
Route::get('/', function () {
  return view('guest.home');
});


// PROFILE
Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
