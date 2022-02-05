<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class productImages extends Model
{
    use HasFactory;


    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];
    protected $fillable = ['product_id' , 'path' , 'name' ];

    public function product(){
        return $this -> belongsTo(Product::class);
    }

}
