<?php
namespace App\Http\Controllers\Api;

use Illuminate\Filesystem\Filesystem as FilesystemFilesystem;


use App\Http\Controllers\Controller;

use App\Models\productImages;
use Illuminate\Http\Request;
use App\Models\Product;
use Dotenv\Util\Str;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use App\Models\User;

use Image;

class ProductImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return productImages::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {




          $uploadedImages = $request->images;
          $idProduct = $request->idProduct;

          $product = Product::where('id' ,$request->idProduct )->get();

          $user=User::where('id' , $product[0]->user_id)->get();

        //   $image = $request->file('images');
        //   $input['imagename'] = time().'.'.$image->extension();


        if($request->images){

          $folderName=$user."/productId/".$idProduct;
          foreach($uploadedImages as $image){
            $imagesCount=random_int(1,1000);

            $filename=$request->idProduct."-".$imagesCount.".".$image->extension() ;

                $img = Image::make($image);
                $img->resize(1280,800, function($constraint){
                $constraint->aspectRatio();
                })->save($image);

            $image->storeAs('products/'.$folderName , $request->idProduct."-".$imagesCount.".".$image->extension(), 'uploads');

            productImages::create([
                'product_id' => $request->idProduct ,
                'path' => 'products/'.$folderName."/".$request->idProduct."-".$imagesCount.".".$image->extension() ,
                'name' => $request->idProduct."-".$imagesCount.".".$image->extension() ,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            }
        }else {

        }






          return response(
              ['fileExtension' => $request->productName,
              'status' => 'success',
          ],200);




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productImages  $productImages
     * @return \Illuminate\Http\Response
     */
    public function show(productImages $productImages)
    {
        return productImages::all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productImages  $productImages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productImages $productImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productImages  $productImages
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {


    $pathImage = productImages::where('id' , $id)->value('path');
    $nameImage = productImages::where('id' , $id)->value('name');

    //dd($pathImage);
    unlink(public_path('/uploads/'.$pathImage));

    $product_id = productImages::where('id' , $id)->value('product_id');

    $images = productImages::where('product_id' , $product_id)->get();

    $folderPath=$pathImage;
    $folderPath=str_replace($nameImage,'',$folderPath);


    if($images->count()<=1){
        File::deleteDirectory(public_path("/uploads/".$folderPath));
    }

   // dd($images->count());

        if (productImages::where('id' , $id)->delete()) {
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
