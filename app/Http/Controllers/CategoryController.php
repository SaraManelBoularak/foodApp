<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;//for retrieving from db 

class CategoryController extends Controller
{
  
  //we dont need construct with authorization since this controller will be used by admin 


   /**
     * Store a new flight in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

  public function store(Request $request){ //to store a new category row in db
        $category= new Category; 

        $category->name= $request->name;
        
        $category->save();
        return response('Data stored successfully', 200);
  }

  
  /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){  //to retrive all the categories list
        $category = DB::table('categories')->get();

        return json_encode($category); 
    }

    public function update(Request $request){ //to edit a specific row in db     
      $id = $request->input('id');
      $category = Category::find($id);
      $name = $request->input('name');
     
      $category->name = $name;

      $category->save();
    }

    public function delete(Request $request){ //to delete a specific row from db
      $id = $request->input('id');
     
      $category = Category::find($id);

      $category->delete();
    }


}
