<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->double('pro_insecticida', 15, 2);
            $table->double('pro_herbicida', 15, 2);
            $table->double('pro_fungicida', 15, 2);
            $table->double('pro_otros', 15, 2);
            $table->double('pro_total', 15, 2);
            $table->double('umf_insecticida', 15, 2);
            $table->double('umf_herbicida', 15, 2);
            $table->double('umf_fungicida', 15, 2);
            $table->double('umf_otros', 15, 2);
            $table->double('umf_total', 15, 2);
            $table->float('tipo_de_cambio');
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
        Schema::drop('market_values');
    }
}
