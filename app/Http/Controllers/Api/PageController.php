<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Typology;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
  public function restaurants()
  {
    $restaurants = Restaurant::with('typologies')->get();

    return response()->json($restaurants);
  }

  public function restaurantsByTypologies($typologies)
  {
    // $array = explode('-', $typologies);
    // $restaurants = Typology::with('restaurants')->where('name', 'italiano')->get();


    // $distinct = [];

    // foreach ($array as $item) {

    // $restaurants = Restaurant::select('id')->with('typologies')->whereHas('typologies', function (Builder $query) use ($item) {
    //   $query->where('id', $item);
    // })->get()->toArray();

    //   foreach($restaurants as $restaurant)
    //   // dump($restaurants);
    // }

    // SELECT `restaurants`.* , count(restaurants.id) 
    // FROM `restaurants`, `typologies`, `restaurant_typology` 
    // WHERE restaurants.id = restaurant_typology.restaurant_id AND  typologies.id = restaurant_typology.typology_id AND restaurant_typology.typology_id 
    // IN (1, 2, 3) 
    // GROUP BY restaurants.id 
    // HAVING count(restaurants.id) = 3;

    $array = [8, 9];


    // $restaurants = Restaurant::select([DB::raw('count(id)'), DB::raw('restaurants.*')])->with('typologies')
    //   ->whereHas('typologies', function (Builder $query) use ($array) {
    //     $query->whereIn('id', $array);
    //   })
    //   ->groupBy('id')
    //   // ->having(DB::raw('count(id)'), '=', 2)
    //   ->get();

    // $restaurants = DB::raw('SELECT `restaurants`.* , count(restaurants.id) FROM `restaurants`, `typologies`, `restaurant_typology` WHERE restaurants.id = restaurant_typology.restaurant_id AND  typologies.id = restaurant_typology.typology_id AND restaurant_typology.typology_id IN (8, 9) 
    // GROUP BY restaurants.id HAVING count(restaurants.id) = 2;');

    $restaurants = Restaurant::with('typologies')->whereHas('typologies', function (Builder $query) use ($array) {
      $query->whereIn('id', $array);
    })
      // ->groupBy('restaurants.id')
      // ->havingRaw('count(restaurants.id) = 2')
      ->get();

    $pippo = [];
    foreach ($restaurants as $restaurant) {
      // dump(count($restaurant->typologies));
      if (count($restaurant->typologies) >= count($array)) {
        $pippo[] = $restaurant;
      }
    }

    return response()->json($pippo);
  }


  public function typologies()
  {
    $typologies = Typology::all();

    return response()->json($typologies);
  }
}
