<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'slug',
    'email',
    'password',
    'address',
    'vat_number',
    'image',
    'description',
    'opening_time',
    'closing_time',
    'day_off',
  ];
}
