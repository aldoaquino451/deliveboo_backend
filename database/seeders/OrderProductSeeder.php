<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $data = config('order_product');

    foreach ($data as $item) {

      $order = Order::where('id', $item['order_id'])->first();

      $product_id = $item['product_id'];

      $order->products()->attach($product_id, ['quantity' => $item['quantity']]);
    };
  }
}
