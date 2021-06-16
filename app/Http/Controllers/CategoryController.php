<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;//in retrieving from db 

class CategoryController extends Controller
{

   /**
     * Store a new flight in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

  public function store(Request $request){
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
    public function index(){
        $category = DB::table('categories')->get();

        return json_encode($category); 
    }

    public function update(Request $request)
    {
     // $input = $request->all();

      // $request->validate([
      //   'name' => 'required|name',
      //  ]);

      // $category = Category::find(1);

      // $category->name = 'Paris to London';

      // $category->save();
      
      $id = $request->input('id');
      $category = Category::find($id);
      $name = $request->input('name');
     
      $category->name = $name;

      $category->save();
    }

    public function delete(Request $request){
      $id = $request->input('id');
     
      $category = Category::find($id);

      $category->delete();
    }


}
