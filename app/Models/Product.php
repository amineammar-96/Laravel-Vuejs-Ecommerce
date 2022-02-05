<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\productImages;
use App\Models\User;
use App\Models\Cart;


class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title' , "id", "description" , 'price' , 'image'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function product_images(){
        return $this->hasMany(productImages::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->belongsTo(Cart::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
