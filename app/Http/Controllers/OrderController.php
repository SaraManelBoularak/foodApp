<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\Orderline;


class OrderController extends Controller
{

    public function __construct(){
        //authaurization to make authentification mendatory
        $this->middleware('auth:sanctum'); 
    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        //we use user_id to get manager's associated restaurant to get manager's orders
        //and we use user_id simply to get client's orders       

        //we fetch user's type and id
        $type = $request->user()->type; 
        $user_id= $request->user()->id;

        if($type=='manager'){  

            $restaurant=DB::table('restaurants')
              ->where('user_id', $user_id)->first();
            
            $restaurant_id= $restaurant->id;

            $orders = DB::table('orders')
              ->where('restaurant_id', '=', $restaurant_id)
              ->orderBy('created_at', 'asc')
              ->get();

            }

        elseif($type=='client'){

            $orders = DB::table('orders')
             ->where('user_id', '=', $user_id)
             ->orderBy('created_at', 'asc')
             ->get();

          }
         
          return json_encode($orders);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){   
        $id = $request->user()->id;
        $order = Order::create($request->all());

        $meals = $request->input('meals', []);
        $quantities = $request->input('quantities', []);
        for ($meal=0; $meal < count($meals); $meal++) {
            if ($meals[$meal] != '') {
                $order->meals()->attach($meals[$meal], ['quantity' => $quantities[$meal]]);
            }
        }
        return response('Data stored successfully', 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $id = $request->input('id');
        $order = Order::find($id);
        $type= $request->user()->type;


        if($type=="manager"){ //update order for manager is changing its state from registered to approved or declined

        $state = $request->input('state');
        
        $order->state = $state; //in the frontend the accept order button will set state to 'approved' and
                                //the decline button will set state to 'declined' 
        $order->save();

        }elseif($type=="client"){ //update order for client is by adding his localisation
            
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');

            $order->latitude = $latitude;
            $order->longitude = $longitude;
            
            $order->save();

        }

    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        
        $id = $request->input('id');
     
        $order = Order::find($id);
  
        $order->delete();
    }
}
