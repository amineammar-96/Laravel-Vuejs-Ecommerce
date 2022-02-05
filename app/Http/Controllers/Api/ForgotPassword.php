<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Mail\ResetPasswordSendMail;
use App\Models\ResetPassword;


class ForgotPassword extends Controller
{
    public function index(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => "email|required|exists:users",
        ]);
        $token ='';

        if ($validator->fails()) {
            return response()->json([
                'message' => "invalid",
                'error' => $validator->errors()
            ]);
        } else {

            $verifyTokenState = ResetPassword::where('email' , $request->email)->get();
            if(count($verifyTokenState)>0){
                $token = Str::random(64);

                ResetPassword::where('email' , $request->email)->update([
                    'token' =>$token
                ]);

            }else {
            $token = Str::random(64);
            DB::table('reset_passwords')->insert([
                'email' => $request->email,
                'token' => $token,
                'status' => "active",

                'created_at' => Carbon::now()
              ]);
            }

            //   Mail::raw('127.0.0.1:8000/#/resetPassword/?email=ammar@outlook.fr&token='.$token , function($message) use($token,$request){
            //     // $message->to($request->email);
            //     $message->to("amineammar20@icloud.com");
            //     $message->subject('Reset Password');

            // });

            $details = [
                'link' => 'http://127.0.0.1:8000/#/resetPassword/?email=ammar@outlook.fr&token='.$token,
            ];

            Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\ResetPasswordSendMail($details));



            return response()->json([
                'message' => "success",

            ]);


        }
    }



    public function verifyResetToken(Request $request){

         $resetToken =ResetPassword::select('*')->where('token' , $request->token)->where('email' , $request->email)->get();
         if(count($resetToken)>0){
             return response()->json([
                 'status' => 'found',
                 'tokenStatus' => $resetToken,
             ]);
         }else{
            return response()->json([
                'status' => 'not found',
            ]);
         }




    }




    public function update(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => "confirmed|required|min:8",
        ]);


        if ($validator->fails()) {
            return response()->json([
                'message' => "invalid",
                'error' => $validator->errors()
            ]);
        } else {
            $user = User::where('email', $request->email)->update([
                'password' => bcrypt($request->password),
            ]);

            $reset = ResetPassword::where('email' , $request->email)->delete();

            return response()->json([
                'status' => 'updated',
            ]);

        }
    }
}
