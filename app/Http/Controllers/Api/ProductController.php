<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Image;

use App\Models\User;

use File;

use App\Models\productImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller

{
    public function getRandomProducts(Request $request){
        //$products=array();
        $products = Product::with("product_images")->get();

        // if(count($products)<25){
        //     return response()->json([
        //         'status' => 'under 5 found',
        //         'products' => $products
        //     ]);
        // }else{
            
            $randomProducts=Product::inRandomOrder()->limit(25)->with("product_images")->where('category' , $request->category)->get();
            return response()->json([
                'status' => 'over 5 found',
                'products' => $randomProducts
            ]);
        // }
    }

    public function getProductsForOneUser(Request $request)
    {
        $products =  Product::where('user_id' , $request->id)->with("product_images")->orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success' ,
            'products' => $products,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::with("product_images")->inRandomOrder()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => "required|min:5|max:25",
            'description' => "required|min:12",
            'price' => "required|numeric",
            'category' => "required|min:3"
            // 'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',

        ]);




        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors(),
            ], 543);
        } else {

            // if($request->image){
            //     $filename = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            //     Image::make($request->image)->save(public_path('/uploads/images/').$filename);
            //     $request->merge(['image' => $filename]);

            // }else {
            //     $filename="";
            // }

            $user = Auth::user();
            $images = $request->images;

            $product = new Product;
            $product->user_id = $request->user_id;
            $product->title = $request->input("title");
            $product->description = $request->input("description");
            $product->quantity = $request->quantity;
            $product->price = $request->input('price');
            $product->category = $request->input('category');;
            $product->updated_at = Carbon::now();
            $product->created_at = Carbon::now();
            $product->save();


            $last = DB::table('products')->latest()->first();
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Product created successfully',
                'idProductValue' => $last,
            ]
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::with("product_images")->where('id', $id)->orderBy('id', 'desc')->get();
        //return Product::where('id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {




        $validator = Validator::make($request->all(), [
            'title' => "required|min:5|max:25",
            'description' => "required|min:12",
            'price' => "required|numeric",
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors(),
            ], 543);
        } else {


            $whoIam = User::where('id', $request->user_id)->get();

            if (count($whoIam) > 0) {
                if ($whoIam[0]->role == "admin") {

                    $product = Product::where('id', $id)->update([
                        'title' => $request->input("title"),
                        'description' => $request->input("description"),
                        'price' => $request->input("price"),
                        'quantity' => $request->input("quantity"),
                        'updated_at' => Carbon::now(),

                    ]);
                    return response()->json([
                        'status' => 'success',
                        'product' => Product::where('id', $id)->get(),
                    ], 200);
                } else if ($whoIam[0]->role == "client") {
                    $productForWho = Product::where('id', $id)->where('user_id', $request->user_id)->get();

                    if (count($productForWho) > 0) {
                        $product = Product::where('id', $id)->update([
                            'title' => $request->input("title"),
                            'description' => $request->input("description"),
                            'price' => $request->input("price"),
                            'quantity' => $request->input("quantity"),
                            'updated_at' => Carbon::now(),


                        ]);
                        return response()->json([
                            'status' => 'success',
                            'product' => Product::where('id', $id)->get(),
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 'failed Auth',

                        ], 543);
                    }
                }
            } else {
                return response()->json([
                    'status' => 'failed Auth',

                ], 543);
            }
        }
    }

    public function edit(Request $request, Product $product)
    {
        return "edit";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {


        $whoIam = User::where('id', $request->user_id)->get();

        if (count($whoIam) > 0) {
            if ($whoIam[0]->role == "admin") {

                $images = productImages::where('product_id', $id);


                if ($images->count() >= 1) {
                    $pathImage = productImages::where('product_id', $id)->first()->value('path');
                    $nameImage = productImages::where('product_id', $id)->first()->value('name');

                    $folderPath = $pathImage;
                    $folderPath = str_replace("/" . $nameImage, '', $folderPath);
                    //rmdir("/uploads/".$folderPath);
                    File::deleteDirectory(public_path("/uploads/" . $folderPath));
                }


                if (Product::where('id', $id)->delete()) {
                    productImages::where('product_id', $id)->delete();
                    return response()->json([
                        'status' => "success"
                    ], 200);
                } else {
                    return response()->json([
                        'status' => "failed"
                    ], 404);
                }
            } else {
                $productForWho = Product::where('id', $id)->where('user_id', $request->user_id)->get();

                if (count($productForWho) > 0) {
                    $images = productImages::where('product_id', $id);


                    if ($images->count() >= 1) {
                        $pathImage = productImages::where('product_id', $id)->first()->value('path');
                        $nameImage = productImages::where('product_id', $id)->first()->value('name');

                        $folderPath = $pathImage;
                        $folderPath = str_replace("/" . $nameImage, '', $folderPath);
                        //rmdir("/uploads/".$folderPath);
                        File::deleteDirectory(public_path("/uploads/" . $folderPath));
                    }


                    if (Product::where('id', $id)->delete()) {
                        productImages::where('product_id', $id)->delete();
                        return response()->json([
                            'status' => "success"
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => "failed"
                        ], 404);
                    }
                }
            }
        } else {
            return response()->json([
                'status' => "failed"
            ], 404);
        }
    }
}
