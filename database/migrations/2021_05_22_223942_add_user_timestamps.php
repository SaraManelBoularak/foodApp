<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasColumn('users', 'created_at', 'updated_at')){
            Schema::table ('users', function (Blueprint $table) {
                $table->timestamps();//if not used, create a new file 
            });    
        }
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table ('users', function (Blueprint $table) {
            $table->dropTimestamps();//if not used, create a new file 
        });    


    }
}
