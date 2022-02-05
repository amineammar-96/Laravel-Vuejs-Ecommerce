<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductImagesController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemsController;
use App\Http\Controllers\Api\UserInfoController;
use App\Http\Controllers\Api\ForgotPassword;
use App\Http\Controllers\Api\CreditCardController;
use App\Http\Controllers\Api\PayementController;
use App\Http\Controllers\api\UserAddressController;
use App\Models\OrderItems;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
// */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("/login" , [UserController::class , "login"]);
Route::post("/register" , [UserController::class , "register"]);


Route::get("/products" , [ProductController::class , "index"] );
Route::get("/products/{id}" , [ProductController::class , "show"] );

Route::post("/getProductsForOneUser" , [ProductController::class , "getProductsForOneUser"] );










Route::group(['middleware' => 'auth:api'] , function(){

    Route::post("/getUserById" , [UserController::class , "index"]);



Route::put("/products/{id}" , [ProductController::class , "update"] );
Route::post("/productDelete/{id}" , [ProductController::class , "destroy"] );
Route::post("/products" , [ProductController::class , "store"] );



Route::post("/uploadProductImages", [ProductImagesController::class , "store"]);
Route::delete('/productImages/{id}', [ProductImagesController::class, 'destroy']);




Route::delete('/productComment/{id}', [CommentController::class, 'destroy']);


Route::post("/cartItemQuantity/{id}", [CartController::class , "updateQuantity"]);

Route::post("/getCart", [CartController::class , "index"]);
Route::post("/cart", [CartController::class , "store"]);
Route::post('/cartDelete/{id}', [CartController::class, 'delete']);




Route::post("/userShippingAddresses", [UserAddressController::class , "index"]);
Route::post("/userShippingAddressesStore", [UserAddressController::class , "store"]);
Route::delete('/userShippingAddressesDelete/{id}', [UserAddressController::class, 'delete']);
Route::post("/userShippingAddressesUpdate", [UserAddressController::class , "update"]);

Route::post("/userShippingAddressesGet", [UserAddressController::class , "getShippingAddress"]);






Route::post("/orders", [OrderController::class , "index"]);
Route::post("/passOrder", [OrderController::class , "store"]);
Route::delete('/orders/{id}', [OrderController::class, 'delete']);

Route::post("/getOrderById", [OrderController::class , "getOrderById"]);

Route::post("/updateOrderStatusAndOrderItemStatus", [OrderController::class , "updateOrderStatusAndOrderItemStatus"]);

Route::post("/updateOrderItemShippingState", [OrderItemsController::class , "updateOrderItemShippingState"]);

Route::post("/OrderItems", [OrderItemsController::class , "index"]);
Route::post("/addOrderItems", [OrderItemsController::class , "store"]);
Route::delete('/OrderItems/{id}', [OrderItemsController::class, 'delete']);
Route::post("/getUserSoldProduct", [OrderItemsController::class , "getUserSoldProduct"]);






Route::post("/getProfile", [UserInfoController::class , "index"]);
Route::post("/profile", [UserInfoController::class , "store"]);


Route::post("/addCreditCard", [CreditCardController::class , "store"]);
Route::get("/lastIndexInPayementTable", [PayementController::class , "lastIndex"]);
Route::post("/addCreditCard", [CreditCardController::class , "store"]);
Route::post("/getCreditCardUser", [CreditCardController::class , "index"]);




Route::post("/sendOrderConfirmationMail", [OrderController::class , "sendOrderConfirmationMail"]);



});



////////////////////////////////////////////////////////////


Route::post("/productComment/{id}", [CommentController::class , "index"]);

Route::get("/productComment", [CommentController::class , "show"]);
Route::post("/productComment", [CommentController::class , "store"]);


Route::get('/getProductImages', [ProductImagesController::class, 'show']);
Route::post('/getRandomProducts', [ProductController::class, 'getRandomProducts']);



Route::post("/forgotPasswordEmailStatus", [ForgotPassword::class , "index"]);
Route::post("/resetPassword", [ForgotPassword::class , "update"]);
Route::post("showUser", [UserController::class , "showUser"]);



Route::post("sendEmailVerificationMail", [UserController::class , "sendEmailVerificationMail"]);
Route::post("verifyResetToken", [ForgotPassword::class , "verifyResetToken"]);
Route::post("emailVerification", [UserController::class , "emailVerification"]);





Route::post("/confirmOrderItemReceive/{id}", [OrderItemsController::class , "confirmOrderItemReceive"]);

Route::post("/denyOrderItemReceive/{id}", [OrderItemsController::class , "denyOrderItemReceive"]);

Route::post("/sendEmailShippingStatusChanged", [OrderItemsController::class , "sendEmailShippingStatusChanged"]);



Route::post('/lastLogin' , [UserController::class , 'lastlognUpdate']);
