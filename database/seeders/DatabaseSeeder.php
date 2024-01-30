<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      // tabelle no id
      UsersSeeder::class,
      TypologiesSeeder::class,
      CategoriesSeeder::class,

      // tabelle con id
      RestaurantsSeeder::class,
      ProductsSeeder::class,
      OrdersSeeder::class,

      // tabella pivot
      RestaurantTypologySeeder::class,
      OrderProductSeeder::class,
    ]);
  }
}
