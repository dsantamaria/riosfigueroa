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
            $table->integer('anio');
            $table->string('entidad');
            $table->double('superficie_sembrada', 16, 2);
            $table->double('superficie_cosechada', 16, 2);
            $table->double('valor_produccion', 16, 2);
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
