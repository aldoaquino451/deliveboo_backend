<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Functions\Helper;
use App\Models\Restaurant;
use Laravel\Prompts\Prompt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

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
        $restaurant = Restaurant::where('user_id', Auth::id())->first();

        $products = Product::where('restaurant_id', $restaurant->id)->get();

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
    public function store(ProductRequest $request)
    {
    $restaurant_id = Restaurant::where('user_id', Auth::id())->first()->id;
      
    $form_data = $request->validated();
    $form_data['slug'] = Helper::generateSlug($form_data['name'], Product::class);
    $form_data['is_visible'] = $request->has('is_visible') ? 1 : 0;
    $form_data['is_vegan'] = $request->has('is_vegan') ? 1 : 0;

    $new_product = new Product();
    $new_product->restaurant_id = $restaurant_id;

    //Salvataggio dell'immagine
    if (array_key_exists('image', $form_data)) {
        $form_data['image'] = Storage::put('uploads/products', $form_data['image']);
        $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
    }

    $new_product->fill($form_data);
    $new_product->save();

    return redirect()->route('admin.products.index')->with('success', 'Il prodotto è stato creato correttamente');
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
        $form_data['is_visible'] = $request->has('is_visible') ? 1 : 0;
        $form_data['is_vegan'] = $request->has('is_vegan') ? 1 : 0;

        if ($product->name === $form_data['name']) {
        $form_data['slug'] = $product->slug;
        } else {
        $form_data['slug'] = Helper::generateSlug($form_data['name'], Product::class);
        }


        if(array_key_exists('image', $form_data)){
            if($product->image){
                Storage::disk('public')->delete($product->image);
            }

            if (array_key_exists('image', $form_data)) {
                $form_data['image'] = Storage::put('uploads/products', $form_data['image']);
                $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
            }
        }


        $product->update($form_data);

        return redirect()->route('admin.products.index')->with('success', 'Il prodotto è stato modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image){
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Il prodotto è stato eliminato correttamente');
    }
}