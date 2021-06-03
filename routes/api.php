<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 
//Route::view('/add','addclient');
//Route::post('/add',[appUserController::class,'addData']);
//Route::post('add', 'App\Http\Controllers\appUserController@addData');
 
//Route::view('/addM','addmanager');
//Route::post('/addM',[appUserController::class,'addData']);

//Route::view('/addU','addappuser');
//Route::post('/addU',[appUserController::class,'addData']);
 
Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');

//Route::apiResource('orders','OrderController');
//Route::apiResource('restos','RestaurantController');
//Route::middleware('restos')->group(base_path('App\Http\Controllers\RestaurantController;'));
