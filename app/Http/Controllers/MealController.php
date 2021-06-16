<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Meal;

//use App\Http\Controllers\RestaurantController;
use App\Models\Restaurant;

class MealController extends Controller
{
    //

    public function __construct(){ 
        //authaurization 
        $this->middleware('auth:sanctum'); //->only(['create']);
    
    }

    public function store( Request $request){ //used to add a meal
         $id = $request->user()->id; 

          //= restaurant::where('user_id', $id)->get(); 
          $restaurant= DB::table('restaurants')->where('user_id', $id)->first();
         $restaurant_id= $restaurant->id;
         
         

         $meal= new Meal;

         $meal->name= $request->name;
         $meal->price= $request->price;
         $meal->photo= $request->photo;
         $meal->category_id= $request->category_id;
         $meal->restaurant_id= $restaurant_id;
         

 
         $meal->save();
         return response('Data stored successfully', 200);
    }

    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $meal = DB::table('meals')->get();

        return json_encode($meal); 
    }

    
    public function update(Request $request){
      $id = $request->input('id');
      $meal = Meal::find($id);
      
      $name = $request->input('name');
      $price = $request->input('price');
      $photo = $request->input('photo');


      $meal->name = $name;
      $meal->price = $price;
      $meal->photo = $photo;

      $meal->save();
    }

    public function delete(Request $request){
      $id = $request->input('id');
     
      $meal = Meal::find($id);

      $meal->delete();
    }

    




}
