<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $restaurant = Restaurant::where('user_id', Auth::id())->first();

    if ($restaurant) {
      $products = Product::where('restaurant_id', $restaurant->id)->get();
    } else {
      $products = null;
    }

    return view('admin.products.index', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = Category::all();

    return view('admin.products.create', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $restaurant_id = Restaurant::where('user_id', Auth::id())->first()->id;

    $form_data = $request->all();
    $form_data['slug'] = Helper::generateSlug($form_data['name'], Product::class);

    $new_product = new Product();
    $new_product->restaurant_id = $restaurant_id;
    $new_product->fill($form_data);
    $new_product->save();

    return redirect()->route('admin.products.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(Product $product)
  {
    return view('admin.products.show', compact('product'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Product $product)
  {
    $categories = Category::all();

    return view('admin.products.edit', compact('product', 'categories'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Product $product)
  {
    $form_data = $request->all();

    if ($product->name === $form_data['name']) {
      $form_data['slug'] = $product->slug;
    } else {
      $form_data['slug'] = Helper::generateSlug($form_data['name'], Product::class);
    }

    $product->update($form_data);

    return redirect()->route('admin.products.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Product $product)
  {
    $product->delete();
    return redirect()->route('admin.products.index');
  }
}
