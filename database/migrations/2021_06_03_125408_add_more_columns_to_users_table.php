<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('users', 'phone', 'firstName', 'lastName', 'deliveryAdress') ){
            Schema::table('users', function (Blueprint $table) {
                $table->integer('phone')->nullable();
                $table->string('firstName')->nullable();
                $table->string('lastName')->nullable();
                $table->string('deliveryAdress')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('firstName');
            $table->dropColumn('lastName');
            $table->dropColumn('deliveryAdress');
        });
    }
}
