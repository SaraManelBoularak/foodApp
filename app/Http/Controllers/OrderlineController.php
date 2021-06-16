<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orderline;

use Illuminate\Support\Facades\DB;

class OrderlineController extends Controller
{
    //
    public function __construct(){ 
        //authaurization 
        $this->middleware('auth:sanctum'); //->only(['create']);
    
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $id = $request->user()->id;
        //User order 
        $order= DB::table('orders')->where('user_id', $id)->first()->id;
        //$order_id=$order->id;
        $orderlines = $request->all();

        foreach($orderlines as $orderline){
            echo($orderline);
        }

        // foreach($orderline as $orderline){
        //     $orderline->order_id = $order;

        //     $orderline->meal_id = $request->meal_id;
        //     $orderline->quantity = $request->quantity;
            
        //     $orderline->save();
           
        //     return response('Data stored successfully', 200);
        // }
        
    }
    

}
