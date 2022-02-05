<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Product;

class CartController extends Controller
{


    public function index(Request $request)
    {

        $cartItems = Cart::where('user_id', $request->user_id)->get();

        return response()->json([
            'status' => 'success',
            'cartItems' =>  $cartItems,

        ]);
    }


    public function store(Request $request)
    {

        $itemCount = Cart::where('product_id', $request->id )->where('user_id' , $request->user_id)->get();


        if ( $itemCount && count($itemCount) > 0) {

            Cart::where('product_id', $request->id)->update(['quantity' => DB::raw($itemCount[0]->quantity + $request->quantity),]);

            $itemCountRes = Cart::where('product_id', $request->id)->where('user_id' , $request->user_id)->get();


            $cartItemCountIconValue = Cart::where('user_id' , $request->user_id)->get();

            return response()->json([
                'status' => "success2",
                'cartItem' => $itemCountRes,
                 'cartItemCountIconValue' => $cartItemCountIconValue

            ]);
        } else {


            $cartItem = new Cart;
            $cartItem->name = $request->title;



            if(count($request->product_images)){
                $cartItem->image = $request->product_images[0]['path'];
            }else {
                $cartItem->image = "products/123.webp";
            }



            $cartItem->quantity = $request->quantity;
            $cartItem->product_id = $request->id;
            $cartItem->user_id = $request->user_id;
            $cartItem->seller = $request->seller;
            $cartItem->price = $request->price;
            $cartItem->created_at = Carbon::now();
            $cartItem->updated_at = Carbon::now();


            $cartItem->save();

             $cartItemCountIconValue = Cart::where('user_id' , $request->user_id)->get();


            return response()->json([
                'status' => "success",
                'cartItem' => $cartItem,
                 'cartItemCountIconValue' => $cartItemCountIconValue

            ]);
        }
    }



    public function updateQuantity($id  , Request $request)
    {


         Cart::where('id', $id)
                ->update([
                    'quantity' => $request->value,
                ]);

        return response()->json([
            'status' => 'Quantity updated' ,

        ]);

    }


    public function delete($id , Request $request)
    {

         $cartitem = Cart::where('id', $id)->delete();

         $cartItemCountIconValue = Cart::where('user_id' , $request->user_id)->get();

        return response()->json([
            'cartItemCountIconValue' => $cartItemCountIconValue ,

        ]);
    }
}
