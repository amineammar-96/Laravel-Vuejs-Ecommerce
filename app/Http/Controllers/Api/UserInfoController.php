<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserInfo;

use Illuminate\Support\Facades\Validator;

class UserInfoController extends Controller
{
    public function index(Request $request)
    {


        $userInfoItem = UserInfo::where('user_id', $request->id)->get();

        if (count($userInfoItem)>0) {
            return response()->json([
                'status' => "found",
                'userInfoItem' => $userInfoItem
            ]);
        } else {

            return response()->json([
                'status' => "not found",
            ]);
        }
    }



    public function store(Request $request)
    {

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

            if(!($request->buldingCode)){
                $request->buldingCode = '0000' ;
            }


        $userInfoItem = UserInfo::where('user_id', $request->id)->get();

        if (count($userInfoItem)>0) {


            UserInfo::where('user_id', $request->id)->update([

                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'addressComp' => $request->addressComp,
                'city' => $request->city,
                'postalCode' => $request->postalCode,
                'buldingCode' => $request->buldingCode,
                //'country' => $request->country,

            ]);
            return response()->json([
                'status' => "updated",
                'userInfoItem' => $userInfoItem
            ]);

        } else {

            $userInfoAux = new UserInfo;
            $userInfoAux->user_id=$request->id;
            $userInfoAux->name=$request->name;
            $userInfoAux->phone=$request->phone;
            $userInfoAux->address=$request->address;
            $userInfoAux->addressComp=$request->addressComp;
            $userInfoAux->city=$request->city;
            $userInfoAux->country=$request->country;

            $userInfoAux->postalCode=$request->postalCode;
            $userInfoAux->buldingCode=$request->buldingCode;
            $userInfoAux->save();

            return response()->json([
                'status' => "created",
                'userInfos' => $userInfoAux
            ]);
        }
    }}
}
