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
    $array = [8, 9];
    // $array = explode('-', $typologies);

    $restaurants = DB::raw('SELECT `restaurants`.* , count(restaurants.id) FROM `restaurants`, `typologies`, `restaurant_typology` WHERE restaurants.id = restaurant_typology.restaurant_id AND  typologies.id = restaurant_typology.typology_id AND restaurant_typology.typology_id IN (8, 9) GROUP BY restaurants.id HAVING count(restaurants.id) = 2;');



    dd($restaurants);
    // $restaurants = Restaurant::with('typologies')->whereHas('typologies', function (Builder $query) use ($array) {
    //   $query->whereIn('id', $array);
    // })
    //   ->groupBy('restaurants.id')
    //   ->havingRaw('count(restaurants.id) = 2')
    //   ->get();

    return response()->json($restaurants);
  }


  public function typologies()
  {
    $typologies = Typology::all();

    return response()->json($typologies);
  }
}
