<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\User;
use App\Models\CreditCard;

class Payement extends Model
{
    use HasFactory;
    protected $fillable = [
        'card_card_id',
        'user_id',
        'order_id',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function creditCards(){
        return $this->belongsTo(CreditCard::class);
    }
}
