<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'user_id',
        'product_id',
        'quantity',
        'seller',
        'price'

    ];
    public function products(){
        return $this->hasMany(Product::class);
    }



    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];
}
