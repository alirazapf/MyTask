<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\product1;
use App\Models\Product;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/index', [product1::class, 'index']);

//Route::get('/index', [\App\Http\Controllers\Product::class, 'show']);
Route::delete('/product/del/{id}', [\App\Http\Controllers\Product::class, 'destroy']);
Route::get('/product/show', [\App\Http\Controllers\Product::class, 'show']);
Route::put('/product/update/{id}', [\App\Http\Controllers\Product::class, 'update']);
Route::post('/product/store', [\App\Http\Controllers\Product::class, 'store']);




//ORDER TABLE CRUD
Route::get('/order/show', [\App\Http\Controllers\Order::class, 'show']);
Route::delete('/order/del/{id}', [\App\Http\Controllers\Order::class, 'destroy']);
Route::put('/order/update/{id}', [\App\Http\Controllers\Order::class, 'update']);
Route::post('/order/create', [\App\Http\Controllers\Order::class, 'store']);



//CONTACT TABLE CRUD
Route::get('/contact/show', [\App\Http\Controllers\Contact::class, 'show']);
Route::delete('contact/del/{id}', [App\Http\Controllers\Contact::class, 'destroy']);
Route::put('contact/update/{id}', [App\Http\Controllers\Contact::class, 'update']);
Route::post('/contact/store', [\App\Http\Controllers\Contact::class, 'store']);


//CATEGORY TABLE CRUD
Route::get('/category/show', [App\Http\Controllers\Category::class, 'show']);
Route::delete('/category/del/{id}', [\App\Http\Controllers\Category::class, 'destroy']);
Route::put('category/update/{id}', [App\Http\Controllers\Category::class, 'update']);
Route::post('/category/store', [\App\Http\Controllers\Category::class, 'store']);











//Route::delete('/category/del/{id}', [App\Http\Controllers\Category::class, 'destroy']);
//Route::delete('category/del/{id}', [App\Http\Controllers\Category::class, 'destroy']);
//Route::get('/contact/show',  [\App\Http\Controllers\Contact::class, 'show']);






Route::post('/auth/create', [\App\Http\Controllers\AuthController::class, 'createUser']);
Route::post('/auth/login',  [\App\Http\Controllers\AuthController::class, 'loginUser']);
Route::post('/auth/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:api');
Route::get('register/verify/{token}',[\App\Http\Controllers\AuthController::class, 'verify']);
Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');


Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password')->middleware('auth:api'); 
Route::post('/forget-password', [AuthController::class, 'forgetpassword'])->name('forget-password'); 
Route::post('/reset-forget-password/{token}', [AuthController::class, 'resetForgetPassword'])->name('reset-forget-password');