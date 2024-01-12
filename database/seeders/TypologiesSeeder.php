<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Typology;

class TypologiesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $typologies = config('typologies');
    foreach ($typologies as $typology) {
      $new_typology = new Typology();
      $new_typology->name = $typology;

      $new_typology->save();
    }
  }
}
