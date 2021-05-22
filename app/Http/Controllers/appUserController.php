<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppUser;
use Illuminate\Support\Facades\Hash;


class appUserController extends Controller
{
    //
        function addData(Request $req){
            $appuser= new AppUser;
          
            $appuser->email=$req->email;
            $appuser->password=Hash::make($req->password);
            
            $appuser->usertype=$req->usertype;
            
            $appuser->save();
            return ("your account has been successfuly added");
          
          }
      
}
