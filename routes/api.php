<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommonQuastionsController;
use App\Http\Controllers\Api\CommunicationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemsController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductImagesController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\StoreImagesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::prefix('auth')->group(function(){
    Route::group(['middleware' =>'ChangeLanguage', 'prefix' => 'auth/'], function () {

        Route::post('register',[AuthController::class,'register']);

        Route::post('login', [AuthController::class,'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        // Route::post('logout', [AuthController::class,'logout']);

        Route::post('password/email', [AuthController::class,'forget'])->name('password.sent');

        Route::post('password/reset', [AuthController::class,'reset']);

        Route::post('email/verification-notification', [AuthController::class,'sendVerificationEmail']);

        Route::post('verify-email', [AuthController::class,'verify']);

    });

Route::group([
    'middleware' => 'ChangeLanguage'],
     function(){
        //user profile
        Route::get('profile',[UserController::class,'profile']);
        Route::post('user/update/profile',[UserController::class, 'updateProfile']);
        // Route::post('user/forgot/password', [UserController::class, 'forgotPassword']);
        Route::post('user/password/update', [UserController::class, 'updatePassword']);

        // product
        Route::apiResource('product',ProductController::class);
        //products
        Route::get('products/favorites', [ProductController::class, 'favorites'])->name('products.favorites');
        Route::post('add/product/favorites', [ProductController::class, 'addproductToFavorites'])->name('add.Product.favorites');
        Route::post('remove/product/favorites', [ProductController::class, 'removeProductFromFavorites'])->name('remove.product.favorites');
        //  product images
        Route::apiResource('product_images', ProductImagesController::class);

        //category
        Route::apiResource('category',CategoryController::class);
        //:get('category/filter',[CategoryController::class,'filter']);

        //  store
        Route::apiResource('store', StoreController::class);

         // rating
        Route::apiResource('rating', RatingController::class);
        // settings
        Route::get('get/setting/data', [SettingController::class, 'getData'])->name('get.setting');
        Route::post('contact-us' , [CommunicationController::class , 'ContactUs']);
        //Common Quastions
        Route::get('common-quastions', [CommonQuastionsController::class, 'index']);
        //order
        Route::resource('order', OrderController::class);

        // order-items
        Route::resource('order_items', OrderItemsController::class);

         //  store - images
        Route::resource('store_images', StoreImagesController::class);

        



    }
);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
