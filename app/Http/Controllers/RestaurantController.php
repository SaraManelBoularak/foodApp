<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class RestaurantController extends Controller
{

    public function __construct(){ 
        //authaurization to make authentification mendatory 
        $this->middleware('auth:sanctum'); //->only(['create']);
    
    }

    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(){
        $restaurant = DB::table('restaurants')->get(); 
        return json_encode($restaurant);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

       $id = $request->user()->id; 
       
        $restaurant= new Restaurant;

        $restaurant->name= $request->name;
        $restaurant->phone= $request->phone;
        $restaurant->adress= $request->adress;
        $restaurant->user_id= $id;
        
        $restaurant->save();

        return response('Data stored successfully', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $id = $request->input('id');
      $restaurant = Restaurant::find($id);
      
      $name = $request->input('name');
      $workHours = $request->input('workHours');
      $phone = $request->input('phone');
      $photo = $request->input('photo');
      $status = $request->input('status');
      $adress = $request->input('adress');
      $rate = $request->input('rate');
      

      $restaurant->name = $name;
      $restaurant->workHours= $workHours;
      $restaurant->phone = $phone;
      $restaurant->photo = $photo;
      $restaurant->status = $status;
      $restaurant->adress = $adress;
      $restaurant->rate = $rate;
      
      $restaurant->save();

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
      return response($restaurant, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
      //we request the id for the desired restaurant to delete
      $id_res = $request->input('id');
      //we get the row for that id
      $restaurant = Restaurant::find($id_res);
      //we delete that row
      $restaurant->delete();
    }

}
