<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper;
use App\Models\Restaurant;
use App\Models\Tipology;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = config('restaurants');
        foreach ($restaurants as $restaurant) {
            $new_restaurant = new Restaurant();
            $new_restaurant->user_id = $restaurant['user_id'];
            $new_restaurant->name = $restaurant['name'];
            $new_restaurant->email = $restaurant['email'];
            $new_restaurant->address = $restaurant['address'];
            $new_restaurant->vat_number = $restaurant['vat_number'];
            $new_restaurant->image = $restaurant['image'];
            $new_restaurant->description = $restaurant['description'];

            $new_restaurant->save();
        }
    }
}
