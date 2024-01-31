<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergensSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $allergens = config('allergens');

    foreach ($allergens as $allergen) {
      $new_allergen = new Allergen();

      $new_allergen->name = $allergen['name'];
      $new_allergen->image = $allergen['image'];

      $new_allergen->save();
    }
  }
}
