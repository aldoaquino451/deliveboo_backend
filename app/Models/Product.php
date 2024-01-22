<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\Category;

class Product extends Model
{
  use HasFactory;

  public function restaurant()
  {
    return $this->belongsTo(Restaurant::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function orders()
  {
    return $this->belongsToMany(Order::class);
  }

  protected $fillable = [
    'name',
    'slug',
    'price',
    'image',
    'image_original_name',
    'is_visible',
    'is_vegan',
    'ingredients',
    'restaurant_id',
    'category_id'
  ];
}
