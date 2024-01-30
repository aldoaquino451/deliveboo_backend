<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {
    $orders_list = Order::where('restaurant_id', Auth::id())->get();

    // $monthTotal = Order::selectRaw('SUM(total_price) as total, MONTH(created_at) as month')
    // ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
    // ->get();

    return view('admin.dashboard.index', compact('orders_list'));
  }
}
