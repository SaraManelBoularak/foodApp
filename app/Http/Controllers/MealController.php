<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//to retrieve data from db
use App\Models\Meal;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    //
    public function __construct(){ 
        //authaurization to make authentification mendatory
        $this->middleware('auth:sanctum');  
    }

    public function store( Request $request){    //used to add a new meal row to db
      
      //we first get the authentificated user's id   
      $id = $request->user()->id; 
         //we look for the restaurant associated to that user(manager)
         $restaurant= DB::table('restaurants')->where('user_id', $id)->first();
         $restaurant_id= $restaurant->id;
         
         $meal= new Meal; 

         $meal->name= $request->name;
         $meal->price= $request->price;
         $meal->photo= $request->photo;
         $meal->category_id= $request->category_id;
         $meal->restaurant_id= $restaurant_id;
         
         $meal->save();

          // Check if there is an image in the request
        if ($request->hasFile('image')) {

          $originalImage = $request->file('image');
          
          // Resize the image
          $resizedImage = Image::make($originalImage);
          $resizedImage->resize(null, 200, function ($constraint) {
              $constraint->aspectRatio();
          });
        
          $resizedImage->stream();

          Storage::disk('local')->put('public/images/meal/' . $meal->id, $resizedImage, 'public');
      
        }

        return response($meal, 201);
    }

    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        //we retrieve the authentificated user's type
        $type = $request->user()->type; 

        //we get restaurant's id differently depending on the user type
        if($type=='manager'){
          $id = $request->user()->id;
          $restaurant=DB::table('restaurants')
            ->where('user_id', $id)->first();
          $restaurant_id= $restaurant->id;

        }
        elseif($type=='client'){
          $restaurant_id= $request->input('restaurant_id');

        }
        //we search for meals of that restaurant using its "id"
        $meals = DB::table('meals')
            ->where('restaurant_id', '=', $restaurant_id)
            ->orderBy('category_id', 'asc')
            ->get();

             return json_encode($meals);   //we encode the returned data with json
    }

    public function update(Request $request){
      //we request the id for the desired meal to update
      $id = $request->input('id');
      
      //we get the row for that id
      $meal = Meal::find($id);
      //we take input with the new values
      $name = $request->input('name');
      $price = $request->input('price');
      $photo = $request->input('photo');
      //we pass the new values to the model fields
      $meal->name = $name;
      $meal->price = $price;
      $meal->photo = $photo;
      //we save changes
      $meal->save();
    }

    public function delete(Request $request){
      //we request the id for the desired meal to delete
      $id = $request->input('id');
      //we get the row for that id
      $meal = Meal::find($id);
      //we delete that row
      $meal->delete();
    }

    




}
