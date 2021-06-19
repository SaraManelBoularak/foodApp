<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
      //

      public function __construct(){ 
        //authaurization 
        $this->middleware('auth:sanctum')->only(['logout']);
    
    }


    public function register (Request $request){
        //
        $request->validate([
           'email' => 'required|email',
           'password' => 'required',
           'type'=> 'required',
        ]); 
        //check if the user already exists 
        $user= User::where('email', $request->email)->first(); 
        if ($user){
            return response('The provided email already exists', 403); //http code: 403 =operation forbiden
        }
         
        $input = $request->all(); 
        $input['password'] = Hash::make($input['password']); //we hash the password to store it the the database
       
        $user = User::create($input); //we create a new user 

        $response['token'] = $user->createToken($request->email)->plainTextToken; //we create his token
        $response['user'] = $user;
        return response(json_encode($response), 201);    //http code: 201 =created

    }



    public function login (Request $request){
        //
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        //we retrieve the user with the inserted email
        $user = User::where('email', $request->email)->first(); 
    
        //we decrypt the password and verify if it's the same
        if (! $user || ! Hash::check($request->password, $user->password)) { 
            return response('The provided credentials are incorrect', 403); //403: operation forbiden
        }
       
       //we generate a token for this user
       $response['token'] = $user->createToken($request->email)->plainTextToken;
       $response['user'] = $user;
       
       return response(json_encode($response));
       }



     public function logout(Request $request){
           // Get the authentificated user
           $user = request()->user(); 
           $id= $user->id;
           //delete current user's token
           $token= DB::table('personal_access_tokens')
           ->where('tokenable_id',$id)
           ->delete();
     }
    
}
