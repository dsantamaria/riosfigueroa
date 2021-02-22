<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketFourthFrameUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_fourth_frame_usages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('farm');
            $table->string('states');
            $table->string('problem');
            $table->string('sembradasHa');
            $table->string('tratadasHa');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('priceDis');
            $table->string('dosisHa');
            $table->string('priceHa');
            $table->string('cicloApp');
            $table->string('priceApp');
            $table->string('priceMarketPot');
            $table->string('marketPotencialApp');
            $table->string('probablyApp');
            $table->string('marketProbably');
            $table->string('objective');
            $table->string('msHa');
            $table->string('msWish');
            $table->string('lt');
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
        Schema::drop('market_fourth_frame_usages');
    }
}
