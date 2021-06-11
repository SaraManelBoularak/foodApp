<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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


 
// Route::group(['middleware' => ['api']], function () {
//     // your routes here

//   });
 

  Route::post('register', 'App\Http\Controllers\AuthController@register'); //signup user
  Route::post('login', 'App\Http\Controllers\AuthController@login');//login user
  Route::post('authuser', 'App\Http\Controllers\AuthController@showAuth'); //show the authentificated user
  Route::post('logout', 'App\Http\Controllers\AuthController@logout'); //logout 

  Route::post('users', 'App\Http\Controllers\UserController@index'); //users list (we dont need it, just testing)

//Route::apiResource('orders','OrderController');
//Route::apiResource('restos','RestaurantController');
//Route::middleware('restos')->group(base_path('App\Http\Controllers\RestaurantController;'));
 

Route::post('newrestau', 'App\Http\Controllers\RestaurantController@store'); //create a restaurant ->requires login
Route::post('restaulist', 'App\Http\Controllers\RestaurantController@list'); //restaurants list ->requires login
Route::post('updaterestau', 'App\Http\Controllers\RestaurantController@update');


Route::post('newcategory','App\Http\Controllers\CategoryController@store');//new category
Route::post('categorylist','App\Http\Controllers\CategoryController@index');//category list
Route::post('categoryupdate','App\Http\Controllers\CategoryController@update');//update category
Route::post('categorydelete','App\Http\Controllers\CategoryController@delete');//delete category