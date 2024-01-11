<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class Order extends Model
{
  use HasFactory;

     public function restaurant () {
    return $this->belongsTo(Restaurant::class);
}

  protected $fillable = [
    'order_number',
    'date_delivery',
    'total_price',
    'name',
    'lastname',
    'address',
    'email',
    'phone_number',
  ];
}
