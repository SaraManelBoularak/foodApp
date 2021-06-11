<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Auth; //to check if the user who's making the restau is logged in 

//use App\Http\Controllers\UserController;




class RestaurantController extends Controller
{

    public function __construct(){ 
        //authaurization 
        $this->middleware('auth:sanctum'); //->only(['create']);
    
    }


    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //$restaurant = Restaurant->all(); 
        $restaurant = DB::table('restaurants')->get(); //bro helped fix this ^^
        return json_encode($restaurant);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         //can ba used to register restaurant for a manager
        
        /*$user =DB::table('users')->get();
        if($user['type']=='manager'){
           //
        }*/
       // return $request->user();
       $id = $request->user()->id; 
       // $type= $request->user()->type;    //keep comments till I change enum in column
      
        //if($type="manager"){}
        //else if($type="client"){
        //echo "you cannot add a meal if you're a client";
        //}

        $restaurant= new Restaurant;

        $restaurant->name= $request->name;
        $restaurant->phone= $request->phone;
        $restaurant->adress= $request->adress;
        $restaurant->user_id= $id;
        
        $restaurant->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
