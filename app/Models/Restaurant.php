<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Typology;
use App\Models\Order;

class Restaurant extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function typologies()
    {
        return $this->belongsToMany(Typology::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }



    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'email',
        'address',
        'vat_number',
        'image',
        'description',
    ];
}
