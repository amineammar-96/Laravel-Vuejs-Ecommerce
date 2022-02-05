<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'id',
        'product_id',
        'order_id',
        'quantity',
        'seller',
        'price',
        'image',
        'orderItemStatus',
        'cancled_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function order(){
        return $this -> belongsTo(order::class);
    }
}
