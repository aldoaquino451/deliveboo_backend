<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
  public function index()
  {
    $restaurant = Restaurant::where('user_id', Auth::id())->first();
    $orders_list = Order::where('restaurant_id', $restaurant->id)
      ->orderBy('created_at', 'desc')->get();

    // Formatta la data in italiano
    foreach ($orders_list as $order) {
      $order->formatted_created_at = $order->created_at->format('d/m/Y  -  H:i');
    };
    return view('admin.orders.index', compact('orders_list'));
  }


  public function show(Order $order)
  {

    $order = Order::with('products')->where('id', $order->id)->first();

    if ($order->restaurant->user_id != Auth::id()) {
      abort('404');
    }

    $products = $order->products;

    $totalSum = $products->sum(function ($product) {
      return $product->pivot->quantity * $product->price;
    });




    // $apartments = DB::table('apartments')
    //     ->join('apartment_sponsor', function ($join) {
    //         $join->on('apartments.id', '=', 'apartment_sponsor.apartment_id');
    //     })
    //     ->where('end_date', '>=', Carbon::now())
    //     ->inRandomOrder()
    //     ->get();


    return view('admin.orders.show', compact('order', 'products'));
  }
}
