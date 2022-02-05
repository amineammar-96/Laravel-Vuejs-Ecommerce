<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{




    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'commentBody' => "required|min:10",
            'rating_stars' => "required|numeric|min:0|not_in:0",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors(),
            ], 543);
        } else {
        $comment = new Comment;
        $comment->body = $request->commentBody;
        $comment->user_id=$request->user_id;
        $comment->product_id=$request->product_id;
        $comment->comment_id=$request->comment_id;
        $comment->rating_stars=$request->rating_stars;
        $comment->save();

        $user = User::where('id' ,$request->user_id )->get();

        $ratingAverage = Comment::where('product_id' , $request->product_id)->avg("rating_stars");

       Product::where('id'  , $request->product_id)->update(['ratingAverage'=>$ratingAverage]);

        return response()->json([
            'status' => 'success',
            'user' => $user ,
            'ratingAverage' => $ratingAverage

        ]);
    }

    }





    public function index($id)
    {
        //return Product::with('comments')->get();
        $comments =  DB::table('users')
        ->join('products', 'products.user_id', '=', 'users.id')
        ->join('comments', 'comments.product_id', '=', 'products.id')
        ->where('products.id',  "="  , $id)
        ->orderBy('comments.id' , 'desc')
        ->get();

        return response()->json([
            'comments' => $comments,
        ]);
    }


    public function show()
    {
        //return Product::with('comments')->get();
        // $comments =  DB::table('users')
        // ->join('products', 'products.user_id', '=', 'users.id')
        // ->join('comments', 'comments.product_id', '=', 'products.id')
        // ->orderBy('comments.id' , 'desc')
        // ->get();

        $res= Product::with('comments')->get();
       // $avrRating = Product::with('comments')->avg("rating_stars");
        return response()->json([
             'res' => $res,
             //'average' => $avrRating
         ]);
    }



    public function destroy($id)
    {

        Comment::where('id' , $id)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }


}
