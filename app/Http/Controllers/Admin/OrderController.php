<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
      $orders_list = Order::where('restaurant_id', Auth::id())
      ->orderBy('created_at', 'desc')
      ->get();

          // Formatta la data in italiano
      foreach ($orders_list as $order) {
        $order->formatted_created_at = $order->created_at->format('d/m/Y  -  H:i');
        };

      return view('admin.orders.index', compact('orders_list'));
    }

    public function show(Order $order)
    {

        if($order->restaurant->user_id != Auth::id()){
            abort('404');
        }

      return view('admin.orders.show', compact('order'));
    }


  }
