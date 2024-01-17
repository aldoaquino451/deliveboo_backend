<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Laravel\Prompts\Prompt;

class ProductController extends Controller
{
  public function productToDelete(Product $product)
  {
    $productToDelete = $product;

    $restaurant = Restaurant::where('user_id', Auth::id())->first();

    if ($restaurant) {
      $products = Product::where('restaurant_id', $restaurant->id)->get();
    } else {
      $products = null;
    }

    return view('admin.products.index', compact('products', 'productToDelete'));
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $productToDelete = null;

    $restaurant = Restaurant::where('user_id', Auth::id())->first();

    if ($restaurant) {
      $products = Product::where('restaurant_id', $restaurant->id)->get();
    } else {
      $products = null;
    }

    return view('admin.products.index', compact('products', 'productToDelete'));
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
  public function store(ProductRequest $request)
  {
    $restaurant_id = Restaurant::where('user_id', Auth::id())->first()->id;
    $form_data = $request->validated();
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
    if ($product->restaurant->user_id != Auth::id()) {
      abort('404');
    }

    $categories = Category::all();

    return view('admin.products.edit', compact('product', 'categories'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ProductRequest $request, Product $product)
  {
    $form_data = $request->validated();


    if ($product->name === $form_data['name']) {
      $form_data['slug'] = $product->slug;
    } else {
      $form_data['slug'] = Helper::generateSlug($form_data['name'], Product::class);
    }

    // if (!isset($form_data['is_vegan'])) {
    //   $form_data['is_vegan'] = 0;
    // } else {
    //   $form_data['is_vegan'] = 1;
    // }
    // if (!isset($form_data['is_visible'])) {
    //   $form_data['is_visible'] = 0;
    // } else {
    //   $form_data['is_visible'] = 1;
    // }

    $product->update($form_data);

    return redirect()->route('admin.products.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Product $product)
  {
    $product->delete();
    // $productToDelete = $product->name;
    // dd($productToDelete);
    return redirect()->route('admin.products.index');
  }
}
