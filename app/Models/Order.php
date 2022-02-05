<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItems;
use App\Models\Payement;
use App\Models\UserAddress;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        "paymentId",
        "paymentRef",
        "paymentStatus",
        'amount',
        'userAddress_id',
        'orderStatus',
        'cancled_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }


    public function userAddress(){
        return $this -> belongsTo(UserAddress::class);
    }


    public function order_items(){
        return $this -> hasMany(OrderItems::class);
    }

    public function payement(){
        return $this -> hasMany(Payement::class);
    }
}
