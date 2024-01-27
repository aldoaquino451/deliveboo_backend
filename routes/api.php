<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\Orders\OrderController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::get('typologies', [PageController::class, 'typologies']);

Route::get('restaurants', [PageController::class, 'restaurants']);

Route::get('restaurants-by-typologies/{typologies}', [PageController::class, 'restaurantsByTypologies']);

Route::get('restaurant/{restaurant}', [PageController::class, 'showRestaurant']);

Route::get('restaurant/product-category/{restaurantAndCategoryId}', [PageController::class, 'productByCategory']);

Route::get('save-order/{cart_string}/{name}/{lastname}/{address}/{email}/{phone_number}/{total_price}/{restaurant_id}', [PageController::class, 'saveOrder']);

Route::get('orders/generate', [OrderController::class, 'generate']);

Route::POST('orders/make-payment', [OrderController::class, 'makePayment']);

Route::post('/send-email', [LeadController::class, 'send']);


