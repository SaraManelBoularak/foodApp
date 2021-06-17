<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGeolocationToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasColumn('orders', 'longitude', 'latitude')){
            Schema::table('orders', function (Blueprint $table) {
                $table->decimal('longitude', $precision = 9, $scale = 2)->nullable(); //9 is the total digits and 2 is the decimal digits
                $table->decimal('latitude', $precision = 9, $scale = 2)->nullable();
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
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
        });
    }
}
