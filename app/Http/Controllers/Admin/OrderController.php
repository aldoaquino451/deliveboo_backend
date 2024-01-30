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
      $orders_list = Order::where('restaurant_id', Auth::id())->get();

      // $monthTotal = Order::selectRaw('SUM(total_price) as total, MONTH(created_at) as month')
      // ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
      // ->get();

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
