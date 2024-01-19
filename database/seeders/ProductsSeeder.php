<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = config('products');

        foreach ($products as $product) {
        $new_product = new Product();

        $new_product->category_id = $product['category_id'];
        $new_product->restaurant_id = $product['restaurant_id'];
        $new_product->name = $product['name'];
        $new_product->slug = Helper::generateSlug($product['name'], Product::class);
        $new_product->price = $product['price'];
        $new_product->image = $product['image'];
        $new_product->is_visible = $product['is_visible'];
        $new_product->is_vegan = $product['is_vegan'];
        $new_product->ingredients = $product['ingredients'];

        $new_product->save();
        };
    }
}
