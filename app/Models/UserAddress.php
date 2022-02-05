<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'address',
        'addressComm',
        'city',
        'Country',
        'postalCode',
        'buldingAccess',
        'name' ,
        'defaultAddress',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
