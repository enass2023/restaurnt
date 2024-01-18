<?php

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
Route::post('/register',[App\Http\Controllers\UserController::class,'register']);
Route::post('/login',[App\Http\Controllers\UserController::class,'login']);
Route::post('/logout',[App\Http\Controllers\UserController::class,'logout']);

//....Restaurant...
Route::get('/view/res',[App\Http\Controllers\RestaurantController::class,'index'])->middleware('auth:sanctum');
Route::get('/show/res/{id}',[App\Http\Controllers\RestaurantController::class,'show'])->middleware('auth:sanctum');
Route::post('/search/res',[App\Http\Controllers\RestaurantController::class,'search'])->middleware('auth:sanctum');
Route::post('/add/res',[App\Http\Controllers\RestaurantController::class,'store'])->middleware('auth:sanctum');
Route::post('/update/res/{id}',[App\Http\Controllers\RestaurantController::class,'update'])->middleware('auth:sanctum');
Route::get('/delete/res/{id}',[App\Http\Controllers\RestaurantController::class,'destory'])->middleware('auth:sanctum');

//...ordar...
Route::get('/view/order/{id}',[App\Http\Controllers\OrderController::class,'show'])->middleware('auth:sanctum');
Route::post('/add/order',[App\Http\Controllers\OrderController::class,'store'])->middleware('auth:sanctum');
Route::post('/update/order/{id}',[App\Http\Controllers\OrderController::class,'update'])->middleware('auth:sanctum');
Route::get('/delete/order/{id}',[App\Http\Controllers\OrderController::class,'destory'])->middleware('auth:sanctum');
Route::get('/view/userorder/{id}',[App\Http\Controllers\UserController::class,'user_order'])->middleware('auth:sanctum');


//...item..
// Route::get('/view/item/{id}',[App\Http\Controllers\OrderController::class,'index']);
Route::post('/add/item',[App\Http\Controllers\ItemController::class,'store']);
Route::post('/update/item/{id}',[App\Http\Controllers\ItemController::class,'update']);
Route::get('/delete/item/{id}',[App\Http\Controllers\ItemController::class,'destory']);

//...review
Route::post('/add/review',[App\Http\Controllers\ReviewController::class,'store'])->middleware('auth:sanctum');
Route::post('/update/review/{id}',[App\Http\Controllers\ReviewController::class,'update'])->middleware('auth:sanctum');
Route::get('/delete/review/{id}',[App\Http\Controllers\ReviewController::class,'destory'])->middleware('auth:sanctum');
