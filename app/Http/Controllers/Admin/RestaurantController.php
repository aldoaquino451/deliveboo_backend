<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Typology;
use Illuminate\Support\Facades\Auth;
use App\Functions\Helper;


class RestaurantController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $restaurant = Restaurant::where('user_id', Auth::id())->first();

    $restaurant->image = $restaurant->image
      ? asset('storage/uploads/restaurants/' . $restaurant->image)
      : asset('storage/uploads/restaurants/placeholder_restaurant.jpg');



    $orders = Order::where('restaurant_id', $restaurant->id)->orderBy('created_at', 'desc')->take(5)->get();

    foreach ($orders as $order) {
      $order->formatted_created_at = $order->created_at->format('d/m/Y  -  H:i');
    };

    // dd($orders);
    return view('admin.restaurants.index', compact('restaurant', 'orders'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $typologies = Typology::all();
    return view('admin.restaurants.create', compact('typologies'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $form_data = $request->all();
    $new_restaurant = new Restaurant();
    $form_data['slug'] = Helper::generateSlug($form_data['name'], Restaurant::class);
    $form_data['user_id'] = Auth::id();

    $new_restaurant->fill($form_data);
    $new_restaurant->save();

    if (array_key_exists('typologies', $form_data)) {
      $new_restaurant->typologies()->attach($form_data['typologies']);
    }

    return redirect()->route('admin.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
