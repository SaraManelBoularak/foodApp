<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meal;

class MealController extends Controller
{
    //

    public function create( Request $request){
         //can ba used to register restaunt
         $meal= new Meal;

         $meal->name= $request->name;
         $meal->price= $request->price;
 
         $meal->save();
    }




}
