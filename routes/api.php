<?php

use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\Orders\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Rotte del per stampare i dati, con Page Controller
Route::get('typologies', [PageController::class, 'typologies']);

Route::get('restaurants', [PageController::class, 'restaurants']);

Route::get('restaurants-by-typologies/{typologies}', [PageController::class, 'restaurantsByTypologies']);

Route::get('restaurant/{restaurant}', [PageController::class, 'showRestaurant']);

Route::get('restaurant/product-category/{restaurantAndCategoryId}', [PageController::class, 'productByCategory']);

Route::get('save-order/{cart_string}/{name}/{lastname}/{address}/{email}/{phone_number}/{total_price}/{restaurant_id}', [PageController::class, 'saveOrder']);


// Rotte del pagamento con BrainTree, con Order Controller
Route::get('orders/generate', [OrderController::class, 'generate']);

Route::POST('orders/make-payment', [OrderController::class, 'makePayment']);


// Rotta per stampare le info dell'ultimo ordine effettuato
Route::get('order/{order_id}', [PageController::class, 'getOrder']);
