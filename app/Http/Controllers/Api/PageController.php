<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Typology;
use App\Models\Product;
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
    $restaurant = Restaurant::where('slug', $slug)->with('products.category', 'typologies')->first();

    // if($restaurant->image){
    //     $restaurant->image = asset('storage/uploads/restaurant/' . $restaurant->image);
    // }else{
    //     $restaurant->image = asset('storage/uploads/restaurant/placeholder_restaurant.png');
    // };

    $restaurant->image = $restaurant->image
      ? asset('storage/uploads/restaurants/' . $restaurant->image)
      : asset('storage/uploads/restaurants/placeholder_restaurant.png');

    // Modifica l'URL dell'immagine di ciascun prodotto
    foreach ($restaurant->products as $product) {
      $product->image = $product->image
        ? asset('storage/' . $product->image)
        : asset('storage/uploads/products/placeholder.png');
    }

    return response()->json($restaurant);
  }

  public function productByCategory(Request $request)
  {
    $restaurant_id = $request->query('restaurant_id');
    $category_id = $request->query('category_id');
    $products = Product::where('restaurant_id', $restaurant_id)->where('category_id', $category_id)->with('category')->get();

    $products = $products->map(function ($product) {
      $product->image = $product->image
        ? asset('storage/' . $product->image)
        : asset('storage/uploads/products/placeholder.png');
      return $product;
    });

    return response()->json($products);
  }

  public function saveOrder($name, $lastname, $address, $phone_number, $total_price)
  {
    // trasformo in json la stringa
    // $cart = json_decode($cart_string, true);

    // salvo in un array associativo id prodotto e quantità
    // $product_quantity = [];
    // foreach ($cart as $item) {
    //   $product_quantity[] = [
    //     'product' => $item['product']['id'],
    //     'quantity' => $item['quantity'],
    //   ];
    // };

    // salvo il record del nuovo ordine
    $order = new Order();
    $order->restaurant_id = 5;
    $order->order_number = random_int(1, 100000);
    $order->total_price = $total_price;
    $order->name = $name;
    $order->lastname = $lastname;
    $order->email = 'admin@admin.com';
    $order->address = $address;
    $order->phone_number = $phone_number;
    $order->save();

    // popolo la tabella pivot
    // foreach ($product_quantity as $item) {
    //   $order->products()->attach($item['product'], ['quantity' => $item['quantity']]);
    // }

    return 'success';
  }
}
