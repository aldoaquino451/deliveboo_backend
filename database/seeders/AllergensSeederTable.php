<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergensSeederTable extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $data = [
      [
        'name' => 'glutine',
        'icon' => 'glutine.png'
      ],
      [
        'name' => 'crostacei',
        'icon' => 'crostacei.png'
      ],
      [
        'name' => 'uova',
        'icon' => 'uova.png'
      ],
      [
        'name' => 'pesce',
        'icon' => 'pesce.png'
      ],
      [
        'name' => 'arachidi',
        'icon' => 'arachidi.png'
      ],
      [
        'name' => 'soia',
        'icon' => 'soia.png'
      ],
      [
        'name' => 'latticini',
        'icon' => 'latticini.png'
      ],
      [
        'name' => 'frutta-secca',
        'icon' => 'frutta-secca.png'
      ],
      [
        'name' => 'sedano',
        'icon' => 'sedano.png'
      ],
      [
        'name' => 'senape',
        'icon' => 'senape.png'
      ],
      [
        'name' => 'sesamo',
        'icon' => 'sesamo.png'
      ],
      [
        'name' => 'solfiti',
        'icon' => 'solfiti.png'
      ],
      [
        'name' => 'lupini',
        'icon' => 'lupini.png'
      ],
      [
        'name' => 'molluschi',
        'icon' => 'molluschi.png'
      ]
    ];

    foreach ($data as $item) {
      $allergen = new Allergen();

      $allergen->name = $item['name'];
      $allergen->icon = $item['icon'];

      $allergen->save();
    };
  }
}
