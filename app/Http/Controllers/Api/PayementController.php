<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payement;

class PayementController extends Controller
{
    public function lastIndex(){
        return Payement::latest('id')->first();
    }
}
