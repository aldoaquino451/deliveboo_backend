<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Typology;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
  // Stampa le info dell'ultimo ordine effettuato 
  public function getOrder($order_id)
  {
    $order = Order::with('products')->where('id', $order_id)->first();

    return response()->json($order);
  }

  // Stampa tutte le tipologie nella Home
  public function typologies()
  {
    $typologies = Typology::with('restaurants')->get();
    return response()->json($typologies);
  }


  // Stampa tutti i ristoranti nella Home
  public function restaurants()
  {
    $restaurants = Restaurant::inRandomOrder()->take(4)->with('typologies')->get();

    foreach ($restaurants as $restaurant) {
      $restaurant->image = $restaurant->image
        ? asset('storage/' . $restaurant->image)
        : asset('storage/uploads/placeholder_restaurant.jpg');
    }

    return response()->json($restaurants);
  }


  // Stampa solo i ristoranti associati alle tipologie scelte, nella Home 
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
      ->paginate(4);

    $restaurants->each(function ($restaurant) {
      $restaurant->typologies = json_decode($restaurant->typologies);
    });

    foreach ($restaurants as $restaurant) {
      $restaurant->image = $restaurant->image
        ? asset('storage/' . $restaurant->image)
        : asset('storage/uploads/placeholder_restaurant.jpg');
    }

    return response()->json($restaurants);
  }


  // Stampa tutti i prodotti del ristorante selezionato, in Detail Restaurant
  public function showRestaurant($slug)
  {
    $restaurant = Restaurant::where('slug', $slug)->with('products.category', 'typologies')->first();

    $restaurant->image = $restaurant->image
      ? asset('storage/' . $restaurant->image)
      : asset('storage/uploads/placeholder_restaurant.jpg');

    // Modifica l'URL dell'immagine di ciascun prodotto
    foreach ($restaurant->products as $product) {
      $product->image = $product->image
        ? asset('storage/' . $product->image)
        : asset('storage/uploads/products/placeholder.png');
    }

    return response()->json($restaurant);
  }


  // Stampa solo i prodotti di una determinata categoria, in Detail Restaurant
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


  // Dopo l'avvenuto pagamento, salva nel database il nuovo ordine effettuato
  // Restituisce l'id dell'ordine, da uare dentro Post Payment
  public function saveOrder($cart_string, $name, $lastname, $address, $email, $phone_number, $total_price, $restaurant_id)
  {
    // trasformo in json la stringa
    $cart = json_decode($cart_string, true);

    // ultimo ordine
    $lastOrder = Order::latest('order_number')->first();
    $order_number = $lastOrder ? $lastOrder->order_number + 1 : 1000;

    // salvo il record del nuovo ordine
    $order = new Order();
    $order->restaurant_id = $restaurant_id;
    $order->order_number = $order_number;
    $order->total_price = $total_price;
    $order->name = $name;
    $order->lastname = $lastname;
    $order->email = $email;
    $order->address = $address;
    $order->phone_number = $phone_number;
    $order->save();

    // popolo la tabella pivot
    foreach ($cart as $item) {
      $order->products()->attach($item['id'], ['quantity' => $item['quantity']]);
    }

    return $order->id;
  }
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
