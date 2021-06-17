<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteDeliveryAdressFromOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

          if(Schema::hasColumn('orders', 'deliveryAdress')) {
            Schema::table('orders', function (Blueprint $table) {
                //first drop the delivery adress column since we added long and lat of geolocation
                  $table->dropColumn('deliveryAdress');
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
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
