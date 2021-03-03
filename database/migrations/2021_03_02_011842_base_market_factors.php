<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BaseMarketFactors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_market_factors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state');
            $table->string('farm');
            $table->double('her_price');
            $table->double('inc_price');
            $table->double('fun_price');
            $table->double('otr_price');
            $table->double('factor');
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
        Schema::drop('base_market_factors');
    }
}
