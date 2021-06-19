<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orderline;

use Illuminate\Support\Facades\DB;

class OrderlineController extends Controller
{
    //
    public function __construct(){ 
        //authaurization to make authentification mendatory
        $this->middleware('auth:sanctum'); 
    
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){   //wont be used since we added a function in orders controller
    
          //the user type is client

          //we look for the order associated to that client
          $user_id= $request->user()->id;
          $order_id=DB::table('orders')
               ->where('user_id', $user_id)
               ->where('state', 'registered')
               ->first();

          $orderlines= $request->all();

         foreach($orderlines as $orderline){
            Orderline::create([
              "meal_id" => $orderline['meal_id'],
              "quantity"        => $orderline['quantity'],
              "order_id"      => $order_id,  
            ]);
        }

         return response('Data stored successfully', 200);

    }

 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $order_id = $request->input('order_id');
        $orderlines = DB::table('orderlines')
         ->where('order_id', $order_id)
         ->get();
       
         return json_encode($orderlines);
        
    }
        
}
