<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MealController;

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


  Route::post('register', 'App\Http\Controllers\AuthController@register'); //signup user
  Route::post('login', 'App\Http\Controllers\AuthController@login');//login user
  Route::post('logout', 'App\Http\Controllers\AuthController@logout'); //logout 

  Route::post('users', 'App\Http\Controllers\UserController@index'); //users list (we dont need it, just testing) 

Route::post('newrestau', 'App\Http\Controllers\RestaurantController@store'); //create a restaurant ->requires login
Route::post('restaulist', 'App\Http\Controllers\RestaurantController@list'); //restaurants list ->requires login
Route::post('updaterestau', 'App\Http\Controllers\RestaurantController@update');//update restaurant 


Route::post('newcategory','App\Http\Controllers\CategoryController@store');//new category
Route::post('categorylist','App\Http\Controllers\CategoryController@index');//category list
Route::post('categoryupdate','App\Http\Controllers\CategoryController@update');//update category
Route::post('categorydelete','App\Http\Controllers\CategoryController@delete');//delete category

Route::post('newmeal','App\Http\Controllers\MealController@store');//new meal
Route::post('meals','App\Http\Controllers\MealController@index');//meals list
Route::post('editmeal','App\Http\Controllers\MealController@update');//edit meal
Route::post('deletemeal','App\Http\Controllers\MealController@delete');//delete meal 

Route::post('orders','App\Http\Controllers\OrderController@index');//orders list
Route::post('neworder','App\Http\Controllers\OrderController@store');//new order
Route::post('updateorder','App\Http\Controllers\OrderController@update');//update order

Route::post('neworderline','App\Http\Controllers\OrderlineController@store');//new orderline






