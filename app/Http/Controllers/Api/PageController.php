<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Typology;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function restaurants()
  {
    $restaurants = Restaurant::all();

    return response()->json($restaurants);
  }

  public function restaurantsByTypologies($typologies)
  {
    $restaurants = Typology::with('restaurants')->where('name', $typologies)->get();

    return response()->json($restaurants);
  }

  public function typologies()
  {
    $typologies = Typology::all();

    return response()->json($typologies);
  }
}
