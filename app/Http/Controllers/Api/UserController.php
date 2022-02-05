<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\UserEmailVerification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = User::where('id' , $request->user_id)->get();

        return response()->json([
            'user' => $user
        ]);
    }


    public function showUser(Request $request)
    {
        $user = User::where('email' , $request->email)->get();

        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function lastLogin(Request $request)
    {
        User::where('id' , $request->id)->update([
            'lastLogin' => Carbon::now(),
        ]);


        return response()->json([
            'status' => 'last login updated successfuly'
            
        ]);
    }





    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|min:4",
            'email' => "email|required",
            "password" => "confirmed|required|min:8",
            //'image' => 'required',

        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => "invalid",
                'errors' => $validator->errors()
            ], 422);
        } else {
            $filename="";
            if ($request->image) {
                $filename = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
                Image::make($request->image)->save(public_path('/uploads/avatars/') . $filename);
                $request->merge(['image' => $filename]);
            } else {
                $filename = "default.png";
            }


             $user = User::create([
                 'name' => $request->name,
                 'email' => $request->email,
                 'password'=> bcrypt($request->password),
                 'image' => $filename,
                 "remember_token" => Str::random(10),

             ]);




            $details = [
                'link' => 'http://127.0.0.1:8000/#/emailVerification/?email='.$request->email
            ];

            Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\UserEmailVerification($details));

            $token = $user->createToken('auth')->accessToken;

            return response()->json([
                "status" => 'true', 'token' => $token
            ]);
        }
    }



    public function sendEmailVerificationMail(Request $request){
        $details = [
            'link' => 'http://127.0.0.1:8000/#/emailVerification/?email='.$request->email
        ];

        Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\UserEmailVerification($details));


        return response()->json([
            "status" => 'true'
        ]);
    }



    public function emailVerification(Request $request){

        $user = User::where('email' ,$request->email)->get();
        if($user[0]->email_verified_at == null) {
        User::where('email' , $request->email)->update([
            'email_verified_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => 'done'
        ]);
    }else {
        return response()->json([
            'status' => 'activited'
        ]);
    }


    }



    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => "email|required",
            "password" => "required|min:8",

        ]);


        $validatedData = request([
            "email"  ,
            "password" ,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "invalid",
                'errors' => $validator->errors()
            ]);
        } else {

        if (Auth::attempt($validatedData)) {
            $token = Auth::user()->createToken('auth')->accessToken;
            $user = User::where('email', $request->input('email'))->get();
            return response()->json([
                "status" => "success",
                "token" => $token,
                'user' => $user
            ]);
        } else {
            return response()->json([
                "status" => "wrong email and password",
                "validate" => $validatedData
            ]);
        }
    }
    }
}
