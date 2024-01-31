<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $orders = config('orders');

    foreach ($orders as $order) {
      $new_order = new Order();

      $new_order->restaurant_id = $order['restaurant_id'];
      $new_order->order_number = $order['order_number'];
      $new_order->total_price = $order['total_price'];
      $new_order->name = $order['name'];
      $new_order->lastname = $order['lastname'];
      $new_order->email = $order['email'];
      $new_order->address = $order['address'];
      $new_order->phone_number = $order['phone_number'];
      $new_order->created_at = $order['created_at'];

      $new_order->save();
    };
  }
}
