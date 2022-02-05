<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Validator;

class UserAddressController extends Controller
{
    public function index (Request $request){
        $userShippingAddresses =UserAddress::where('user_id' , $request->user_id)->orderBy('id' , 'desc')->get();

        return response()->json([
            'userShippingAddresses' => $userShippingAddresses,
        ]);
    }

    public function getShippingAddress (Request $request){
        $userShippingAddresses =UserAddress::where('id' , $request->userAddress_id)->get();

        return response()->json([
            'userShippingAddresses' => $userShippingAddresses,
        ]);
    }

    public function getDefaultshippingAddress (Request $request){
        $userDefaultAddress =UserAddress::where('user_id' , $request->user_id)->where('defaultAddress' , 'true')->get();

        return response()->json([
            'userDefaultAddress' => $userDefaultAddress,
        ]);
    }


    public function store (Request $request){


        $validator = Validator::make($request->all(), [
            'name' => "required|min:4",
            'phone' => "required|min:8|max:13",
            "address" => "required|min:5",
            "postalCode" => "required|min:4",
            "city" => "required|min:3",
            "country" => "required|min:3",



        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "invalid",
                'errors' => $validator->errors()
            ]);
        } else {

        $userShippingAddresses =new UserAddress;
        $userShippingAddresses->name = $request->name;
        $userShippingAddresses->phone = $request->phone;
        $userShippingAddresses->address = $request->address;
        $userShippingAddresses->postalCode = $request->postalCode;
        $userShippingAddresses->city = $request->city;
        $userShippingAddresses->country = $request->country;
        $userShippingAddresses->user_id = $request->user_id;

        $userShippingAddressesHistory = UserAddress::where('user_id' , $request->user_id)->get();

        if(count($userShippingAddressesHistory)==0){
            $userShippingAddresses->defaultAddress = "true";

        }else{
            $userShippingAddresses->defaultAddress = "false";

        }




        if($request->addressComp){
            $userShippingAddresses->addressComp = $request->addressComp;

        }
        if ($request->buldingCode){
            $userShippingAddresses->buldingCode = $request->buldingCode;

        }
        $userShippingAddresses->save();


        $userShippingAddressesRes=UserAddress::latest('id')->first();

        return response()->json([
            'userShippingAddressesRes' => $userShippingAddressesRes,
        ]);

    }

    }







    public function update (Request $request){



        $searchForLastDefaultAddress = UserAddress::where('user_id' , $request->user_id)->where('defaultAddress' , 'true')->update([
            'defaultAddress' => 'false'
        ]);



        $deleteSelectAddressToMakeItAfterFirstIndex = UserAddress::where('user_id' , $request->user_id)->where('id' , $request->id )->update([
            'defaultAddress' => 'true'
        ]);





        return response()->json([
            'status' => 'updated',
        ]);



    }




    public function delete($id ){
        $userShippingAddressesDelete = UserAddress::where('id' , $id)->get();
        if($userShippingAddressesDelete){
            if ($userShippingAddressesDelete[0]->defaultAddress == 'true'){
                if(count(UserAddress::where('id' , $id +1)->get()) > 0){
                UserAddress::where('id' , $id + 1)->update([
                    'defaultAddress' => 'true'
                ]);
            }else if(count(UserAddress::where('id' , $id -1)->get()) > 0){
                UserAddress::where('id' , $id + -1)->update([
                    'defaultAddress' => 'true'
                ]);
            }
            }
        }

        UserAddress::where('id' , $id)->delete();
        return response()->json([
            'status' => 'deleted' ,

        ]);
    }






}
