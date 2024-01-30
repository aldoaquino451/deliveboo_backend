<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Typology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTypologySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $data = config('restaurant_typology');

    foreach ($data as $item) {

      foreach ($item['typology_id'] as $index) {
        $restaurant = Restaurant::where('id', $item['restaurant_id'])->first();
        $typology_id = $index;
        $restaurant->typologies()->attach($typology_id);
      }
    };
  }
}
