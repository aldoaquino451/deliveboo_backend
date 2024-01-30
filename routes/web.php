<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RestaurantController;


// ADMIN
Route::middleware(['auth', 'verified'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {
    // rotte CRUD
    Route::resource('/', RestaurantController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);

    // rotte custom
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('products/{product}', [ProductController::class, 'productToDelete'])->name('products-new');

    // Rotte per dati grafici
    Route::get('charts/order/month', [DashboardController::class, 'getDataChart'])->name('getDataChart');
    Route::get('charts/order/year', [DashboardController::class, 'getDataChartYear'])->name('getDataChartYear');

    Route::get('charts/amount/month', [DashboardController::class, 'getAmountChartMonth'])->name('getAmountChartMonth');
    Route::get('charts/amount/year', [DashboardController::class, 'getAmountChartYear'])->name('getAmountChartYear');


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
