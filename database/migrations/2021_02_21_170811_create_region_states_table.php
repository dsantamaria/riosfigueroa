<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_states', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('state_id');
            $table->foreign('state_id')->references('id')->on('mexico_states')->onDelete('cascade');
            $table->unsignedInteger('region_id');
            $table->foreign('region_id')->references('id')->on('user_regions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('region_states');
    }
}
