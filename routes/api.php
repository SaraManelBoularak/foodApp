<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\addAppUserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::view('/add','addclient');
Route::post('/add',[appUserController::class,'addData']);
//Route::post('add', 'App\Http\Controllers\appUserController@addData');
 
Route::view('/addM','addmanager');
//Route::post('/addM',[appUserController::class,'addData']);

Route::view('/addU','addappuser');
Route::post('/addU',[appUserController::class, 'addData']);
