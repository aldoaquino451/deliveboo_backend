<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class Typology extends Model
{
    use HasFactory;

        public function restaurants () {
        return $this->belongsToMany(Restaurant::class);
    }

    protected $fillable = [
        'name'
    ];
}
