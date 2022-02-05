<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use DateTimeInterface;
use App\Models\Payement;
use App\Models\CreditCard;
use App\Models\OrderItems;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Mail;
class OrderController extends Controller

{

    public function updateOrderStatusAndOrderItemStatus(Request $request){

        if($request->action){

            $orderItems =OrderItems::where('id' ,$request->orderItem_id )->update([
                "orderItemStatus" =>  $request->orderItemStatus,
                "canceled_at" =>  Carbon::now(),

            ]);

            $order = OrderItems::where('order_id' , $request->order_id)->where('orderItemStatus' , '<>' , 'Cancelled')->get();
            if(count($order)==0){
                  order::where('id' ,$request->order_id )->update([
                    "orderStatus" =>  $request->orderItemStatus,
                    "canceled_at" =>  Carbon::now(),

                ]);

                $orderStatusUpdate = order::where('id' ,$request->order_id )->get();
                if($orderStatusUpdate[0]->paymentStatus!="Paid"){
                    order::where('id' ,$request->order_id )->update([
                        "paymentStatus" =>  $request->orderItemStatus,

                    ]);
                }

                if($orderStatusUpdate[0]->paymentStatus=="Paid"){
                    order::where('id' ,$request->order_id )->update([
                        "paymentStatus" =>  "Will be reimbursed",
                    ]);
                }


            }
            return response()->json([
                'status' => 'updated'
            ]);
        }else{

        $order = Order::where('id' , $request->order_id)->update([
            'paymentStatus' => $request->paymentStatus,
            'orderStatus' => $request->orderItemStatus,
        ]);

        $orderItems =OrderItems::where('order_id' ,$request->order_id )->update([
            "orderItemStatus" =>  $request->orderItemStatus
        ]);

        return response()->json([
            'order' => $order,
            'orderItems' => $orderItems,

        ]);
    }
    }


    public function getOrderById (Request $request)
    {

        $order = Order::where('id' , $request->order_id)->with('order_items')->orderBy('id' , 'desc')->get();


        $idValue = Payement::where('order_id' ,$request->order_id )->get();
        $userFacturation = UserAddress::where('user_id' ,$request->user_id )->where('defaultAddress' , 'true')->get();
        $user = User::where('id' ,$request->user_id )->get();



        $shippingAddress ="";
        $payementCard = "";



        if($idValue){
        $payementCard = CreditCard::where('id' , $idValue[0]->card_card_id )->get();
        $shippingAddress = UserAddress::where('id' ,$order[0]->userAddress_id)->get();

    }
        //dd($payementCard);
        return response()->json([
            'status' => 'success',
            'order' => $order,
            'payementCard' => $payementCard,
            'userFacturation' => $userFacturation ,
            'shippingAddress' => $shippingAddress,
            'user' => $user,
        ]);

    }




    public function index (Request $request)
    {




        // $orders = Order::where('user_id' , $request->user_id)->orderBy('id' , 'desc')->get();
        // return response()->json([
        //     'status' => 'success',
        //     'orders' => $orders
        // ]);
        $orders = Order::where('user_id' , $request->user_id)->with('order_items')->orderBy('id' , 'desc')->get();

        $orders1 = Order::where('id' , $request->order_id)->with('order_items')->get();

        $idValue = Payement::latest('id')->first();
        $payementCard = "";
        if($idValue){
        $payementCard = CreditCard::where('id' , $idValue->card_card_id )->get();
        }
        //dd($payementCard);
        return response()->json([
            'status' => 'success',
            'orders' => $orders,
            'orders1' => $orders1,
            'payementCard' => $payementCard,
        ]);

    }



    public function store (Request $request){

       // dd($request);
        $order = new Order;
        $order->user_id=$request->user_id;
        $order->paymentId=$request->paymentId;
        $order->paymentRef=$request->paymentRef;
        $order->paymentStatus=$request->paymentStatus;
        $order->amount=$request->amount;
        $order->userAddress_id=$request->userAddress_id;
        $order->created_at=Carbon::now();
        $order->updated_at=Carbon::now();

        $order->save();



        return response()->json([
            'status' => "success",
            'order' => $order
        ]);



    }


    public function update (Request $request){
        return $request;
    }

    public function delete ($id){
        return Order::where('id' , $id)->delete();
    }



    public function sendOrderConfirmationMail (Request $request){

        $orderInfo = Order::where('id' , $request->order_id)->with('order_items')->get();
        // $orderItems = OrderItems::where('order_id' ,$request->order_id)->get();
        $userProfile = User::where('id', $request->user_id)->get();
        $shippingInfo = UserAddress::where('id' , $request->userAddress_id)->get();
        $payementRef = Payement::where('id' ,$orderInfo[0]->paymentId)->get();
        $CreditCard = CreditCard::where('id' ,$payementRef[0]->card_card_id)->get();
        $userDefaultAddress = UserAddress::where('user_id' , $request->user_id)->where('defaultAddress' , 'true')->get();



        $details = [
       'userDefaultAddress' => $userDefaultAddress[0],
        'orderInfo' => $orderInfo[0],
        'userProfile' => $userProfile[0],
        'shippingInfo' => $shippingInfo[0],
        'CreditCard' => $CreditCard[0],
        'payementRef' => $payementRef[0],

    ];

    foreach ($orderInfo[0]->order_items as $orderItemKey => $orderItem) {
        $seller=User::where('id' ,$orderItem->seller )->get();

    }

    foreach ($seller as $sellerKey => $sellerOne) {

        $orderInfo = Order::where('id' , $request->order_id)->with('order_items')->get();

        $orderItemForSeller = OrderItems::where('seller' , $sellerOne->id)->where('order_id' , $request->order_id)->get();

        $details2 = [
            'userDefaultAddress' => $userDefaultAddress[0],
             'orderInfo' => $orderInfo[0],
             'userProfile' => $userProfile[0],
             'shippingInfo' => $shippingInfo[0],
             'CreditCard' => $CreditCard[0],
             'payementRef' => $payementRef[0],
             'orderItemForSeller' => $orderItemForSeller ,
             'seller' => $sellerOne,
         ];



         Mail::to($sellerOne->email)->send(new \App\Mail\OrderConfirmationForSeller($details2));

    }








    Mail::to($userProfile[0]->email)->send(new \App\Mail\orderConfirmation($details));



        return response()->json([
            'status' => "sent"
        ]);
    }


}
