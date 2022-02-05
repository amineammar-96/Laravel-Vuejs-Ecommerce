<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreditCard;
use App\Models\Order;
use App\Models\Payement;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;

class CreditCardController extends Controller
{
    public function index(Request $request){
        $creditCard = CreditCard::where('user_id' , $request->user_id)->get();
        if(count($creditCard) > 0){
        return response()->json([
            'status' => 'found',
            'creditCard' => $creditCard
            ]);
        }else {
            return response()->json([
                'status' => 'not found',
                ]);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'cardNumber' => "required|min:16|max:16",
            // 'cardExpDate' => "required|min:4|max:8",
            // 'user_id' => "required",
            // 'cardType' => "required|min:2",
            // 'cardCvvCode' => "required|min:3|max:5",
            // 'nameOfCard' => "required|min:3"
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors(),
            ]);
        } else {


        $itemCount = CreditCard::where('cardNumber', $request->cardNumber)->get();


        if (count($itemCount) > 0) {

            $itemCard = CreditCard::where('cardNumber', $request->cardNumber)->where('user_id' , $request->user_id)->update([
                'nameOfCard' => $request->nameOfCard,
                'cardNumber' => $request->cardNumber,
                'cardExpDate' => $request->cardExpDate,
                'user_id' => $request->user_id,
                'cardCvvCode' => $request->cardCvvCode,
                'cardType' => $request->cardType,
                'updated_at' => Carbon::now(),

            ]);

            $idValue = CreditCard::where('cardNumber' , $request->cardNumber)->get();
            $payement = new Payement ;
            $payement->card_card_id = $idValue[0]->id;
            $payement->user_id = $request->user_id;
            $idLastOrder = Order::latest('id')->first();
            if(!$idLastOrder){
                $payement->order_id = 1;
            }else{
                $payement->order_id = $idLastOrder->id+1;

            }

            $payement->created_at = Carbon::now();
            $payement->updated_at = Carbon::now();
            $payement->save();

            return response()->json([
                'status' => "success",

            ]);
        } else {


            $creditCard = new CreditCard;
            $creditCard->nameOfCard = $request->nameOfCard;
            $creditCard->cardNumber = $request->cardNumber;
            $creditCard->cardExpDate = $request->cardExpDate;
            $creditCard->user_id = $request->user_id;
            $creditCard->cardCvvCode = $request->cardCvvCode;
            $creditCard->cardType = $request->cardType;
            $creditCard->created_at = Carbon::now();
            $creditCard->updated_at = Carbon::now();
            $creditCard->save();

            $idValue = CreditCard::latest('id')->first();
            //dd('zzzzzz',$idValue);
            $idLastOrder = Order::latest('id')->first();

            $payement = new Payement ;

            if(!$idLastOrder){
                $payement->order_id = 1;
            }else{
                $payement->order_id = $idLastOrder->id+1;

            }
            $payement->card_card_id = $idValue->id;
            $payement->user_id = $request->user_id;
            $payement->created_at = Carbon::now();
            $payement->updated_at = Carbon::now();
            $payement->save();



            return response()->json([
                'status' => "success",
                'creditCard' => $creditCard

            ]);
        }
    }
    }



}
