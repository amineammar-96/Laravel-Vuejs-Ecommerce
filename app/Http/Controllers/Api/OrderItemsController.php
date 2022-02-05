<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItems;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\UserAddress;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Payement;
use App\Models\CreditCard;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderItemsController extends Controller
{

    public function confirmOrderItemReceive($id){

        $orderItemAux= OrderItems::where('id' , $id)->get();
        if($orderItemAux[0]->confirmedReceivedStatus!=""){

        $orderItem= OrderItems::where('id' , $id)->update([
            'confirmedReceivedStatus' => "Received",
            'confirmedReceivedStatus_at' => Carbon::now(),
        ]);

        $order= Order::where('id' , $orderItem[0]->order_id)->update([
            'orderStatus' => "Received"
        ]);
        return response()->json([
            'status' => 'confirmed',
            'orderItem' => $orderItem
        ]);

    }else{
        $order= Order::where('id' , $orderItemAux[0]->order_id)->update([
            'orderStatus' => "Received"
        ]);
        return response()->json([
            'status' => 'already confirmed',
        ]);
    }
    }


    public function sendEmailShippingStatusChanged(Request $request){

        $orderItem = OrderItems::where('id' , $request->orderItemId)->get();

        $wichOrder= Order::where('id' , $orderItem[0]->order_id)->get();

        $userWhoBought = User::where('id' , $wichOrder[0]->user_id)->get();

        $seller = User::where('id' , $orderItem[0]->seller)->get();
        $sellerInfo = UserInfo::where('user_id' , $seller[0]->id)->get();
       
        $confirmLink="http://127.0.0.1:8000/#/confirmOrderItemReceiveAppVue/?orderItem_id=".$orderItem[0]->id."&user_id=".$request->user_id."&product_id=".$orderItem[0]->product_id;

        $denyLink="http://127.0.0.1:8000/#/denyOrderItemReceiveAppVue/?orderItem_id=".$orderItem[0]->id."&user_id=".$orderItem[0]->user_id;


        $details = [
            'orderItem' => $orderItem[0],
            'wichOrder' => $wichOrder[0],
            'userWhoBought' => $userWhoBought[0],
            'seller' => $seller[0],
            'sellerInfo' => $sellerInfo[0],
            'confirmLink' => $confirmLink,
            'denyLink' => $denyLink,

        ];



        Mail::to($userWhoBought[0]->email)->send(new \App\Mail\shippingStatusProductChangedMail($details));

    }

    public function updateOrderItemShippingState (Request $request)
    {

        $orderItem = OrderItems::where('id' , $request->orderItemId)->update([
            'orderItemStatus' => $request->orderItemStatus,
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'status' => 'success',
            'orderItem' => $orderItem
        ]);

    }
    public function index (Request $request)
    {

        if(!$request->order_id ){
            if($request->id){
                $request->order_id=$request->id;
            }
        }


        $orderItems = OrderItems::where('order_id', $request->order_id)->orderBy('id' , 'desc')->get();
        foreach ($orderItems as $key => $orderItem) {
            $shippingAddress = UserAddress::where('id' ,(int)$orderItem->order->userAddress_id)->get();
            $userDefaultAddress = UserAddress::where('user_id' , (int)$orderItem->order->user_id)->get();
            $userWhoBoughtInfo = User::where('id' , (int)$orderItem->order->user_id)->get();

            $sellerUser=User::where('id' , (int)$orderItem->seller)->get();
            $sellerUserAddress = UserInfo::where('user_id' , (int)$orderItem->seller)->get();

            $orderItem->sellerUser= $sellerUser[0];
            $orderItem->sellerUserAddress= $sellerUserAddress[0];

            $orderItem->shippingAddress= $shippingAddress[0];
            $orderItem->userDefaultAddress= $userDefaultAddress[0];
            $orderItem->userWhoBoughtInfo= $userWhoBoughtInfo[0];
        }
        return response()->json([
            'status' => 'success',
            'orderItems' => $orderItems
        ]);

        // $orders = Order::where('id' , $request->user_id)->get();
        // return response()->json([
        //     'status' => 'success',
        //     'orders' => $orders
        // ]);
    }


    public function getUserSoldProduct (Request $request)
    {

         $soldItems = OrderItems::where('seller', $request->id)->with('order')->orderBy('id' , 'desc')->get();

         //  $soldItems = Product::where('user_id', $request->id)->with('order_items')->get();
        foreach ($soldItems as $soldItemKey => $soldItem) {
            // $userShippingAddress = UserAddress::where('user')
            $shippingAddress = UserAddress::where('id' ,(int)$soldItem->order->userAddress_id)->get();
            $userDefaultAddress = UserAddress::where('user_id' , (int)$soldItem->order->user_id)->get();
            $userWhoBoughtInfo = User::where('id' , (int)$soldItem->order->user_id)->get();
            $paymentTransaction = Payement::where('id' , (int)$soldItem->order->paymentId)->get();
            $creditCardPayement = CreditCard::where('id' , (int)$paymentTransaction[0]->card_card_id)->get();

            $soldItem->CreditCard= $creditCardPayement[0];
            $soldItem->shippingAddress= $shippingAddress[0];
            $soldItem->userDefaultAddress= $userDefaultAddress[0];
            $soldItem->userWhoBoughtInfo= $userWhoBoughtInfo[0];

        }
        return response()->json([
            'status' => 'success',
            'soldItems' => $soldItems,
        ]);


    }




    public function store (Request $request){


        $orderItems = new OrderItems;
        $orderItems->name=$request->name;
        $orderItems->image=$request->image;
        $orderItems->quantity=$request->quantity;
        $orderItems->product_id=$request->product_id;
        $orderItems->order_id=$request->order_id;
        $orderItems->seller=$request->seller;
        $orderItems->price=$request->price;
        $orderItems->created_at=Carbon::now();
        $orderItems->updated_at=Carbon::now();

        $orderItems->save();






        return response()->json([
            'status' => "success",
            'orderItems' => $orderItems
        ]);



    }


    public function update (Request $request){
        return $request;
    }

    public function delete ($id){
        return OrderItems::where('id' , $id)->delete();
    }
}
