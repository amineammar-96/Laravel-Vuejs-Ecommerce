<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ResetPassword extends Model
{
    use HasFactory;
    protected $fillable = ['id' , 'token' , 'status' , 'email' , 'created_at' ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $hidden = [
        'token',
    ];
    public $timestamps = false;
}
