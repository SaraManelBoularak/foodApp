<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('orders')){
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                //$table->enum('state', array('existing','registered')); //since we will only be making an ordering app I deleted those options: 'shipped', 'billed', 'ended'
                $table->string('deliveryAdress');
                //$table->enum('paymentMethod', array('cash', 'card'));
    
                $table->timestamps(); //used to get created at time for orders
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
        Schema::dropIfExists('orders');
    }
}
