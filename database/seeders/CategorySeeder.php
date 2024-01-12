<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = config('categories');
        foreach ($categories as $category) {
            $new_category = new Category();
            $new_category->name = $category;

            $new_category->save();
        }
    }
}
