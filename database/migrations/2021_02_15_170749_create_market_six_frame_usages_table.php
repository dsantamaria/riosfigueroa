<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketSixFrameUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_six_frame_usages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('states');
            $table->string('farms');
            $table->string('sembradasHa');
            $table->string('tratadasHA');
            $table->string('spend');
            $table->string('percentIncecticida');
            $table->string('percentHerbicida');
            $table->string('percentFungicida');
            $table->string('percentOtros');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('market_six_frame_usages');
    }
}
