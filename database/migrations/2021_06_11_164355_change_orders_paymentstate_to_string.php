<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeOrdersPaymentstateToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('orders', 'state', 'paymentMethod') ){
            Schema::table('orders', function (Blueprint $table) {
                $table->string('state')->nullable();
                $table->string('paymentMethod')->nullable();
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
            $table->dropColumn('state');
            $table->dropColumn('paymentMethod');
        });
    }
}
