<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Api\Orders\OrderController;


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

    // Rotte per dati grafici
    Route::get('charts/order/month', [OrderController::class, 'getDataChart'])->name('getDataChart');
    Route::get('charts/order/year', [OrderController::class, 'getDataChartYear'])->name('getDataChartYear');

    Route::get('charts/amount/month', [OrderController::class, 'getAmountChartMonth'])->name('getAmountChartMonth');
    Route::get('charts/amount/year', [OrderController::class, 'getAmountChartYear'])->name('getAmountChartYear');


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
