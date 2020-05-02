<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmingProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farming_productions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('año');
            $table->string('cultivo');
            $table->float('superficie_sembrada');
            $table->float('superficie_cosechada');
            $table->float('valor_produccion');
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
        Schema::drop('farming_productions');
    }
}
