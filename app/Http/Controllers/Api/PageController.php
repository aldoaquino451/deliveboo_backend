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

  public function typologies()
  {
    $typologies = Typology::all();
    return response()->json($typologies);
  }

  public function restaurants()
  {
    $restaurants = Restaurant::with('typologies')->get();

    return response()->json($restaurants);
  }

  public function restaurantsByTypologies($typologies)
  {
    $typologies_arr = explode('-', $typologies);

    $restaurants = DB::table('restaurants')
      ->select('restaurants.*')
      ->addSelect(DB::raw('JSON_ARRAYAGG(JSON_OBJECT("id", typologies.id, "name", typologies.name)) as typologies'))
      ->join('restaurant_typology', 'restaurants.id', '=', 'restaurant_typology.restaurant_id')
      ->join('typologies', 'typologies.id', '=', 'restaurant_typology.typology_id')
      ->whereIn('restaurant_typology.typology_id', $typologies_arr)
      ->groupBy('restaurants.id')
      ->havingRaw('COUNT(restaurants.id) = ?', [count($typologies_arr)])
      ->get();

    $restaurants = $restaurants->map(function ($restaurant) {
      $restaurant->typologies = json_decode($restaurant->typologies);
      return $restaurant;
    });

    return response()->json($restaurants);
  }

  // public function restaurantsByTypologies($typologies)
  // {
  // $restaurants = DB::select('SELECT `restaurants`.* , count(restaurants.id) FROM `restaurants`, `typologies`, `restaurant_typology` WHERE restaurants.id = restaurant_typology.restaurant_id AND  typologies.id = restaurant_typology.typology_id AND restaurant_typology.typology_id IN (5, 6, 11) GROUP BY restaurants.id HAVING count(restaurants.id) = 3;');

  // $typologies_arr = explode('-', $typologies);

  // $restaurants = DB::table('restaurants')
  //     ->select('restaurants.*', DB::raw('COUNT(restaurants.id) as restaurant_count'))
  //     ->join('restaurant_typology', 'restaurants.id', '=', 'restaurant_typology.restaurant_id')
  //     ->join('typologies', 'typologies.id', '=', 'restaurant_typology.typology_id')
  //     ->whereIn('restaurant_typology.typology_id', $typologies_arr)
  //     ->groupBy('restaurants.id')
  //     ->havingRaw('COUNT(restaurants.id) = ?', [count($typologies_arr)])
  //     ->get();

  // return response()->json($restaurants);
  // }


  public function showRestaurant($slug)
  {
    $restaurant = Restaurant::where('slug', $slug)->with('products.category', 'categories')->first();

    return response()->json($restaurant);
  }
}
