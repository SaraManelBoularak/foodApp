<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('Restaurants')){
            Schema::create('Restaurants', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('workHours')->nullable();
                $table->integer('phone')->nullable();
                $table->string('photo')->nullable();
                $table->string('adress');
                $table->integer('rate')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('Restaurants');
    }
}
