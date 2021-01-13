<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgricolaSiapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agricola_siaps', function (Blueprint $table) {
            $table->integer('anio');
            $table->integer('mes');
            $table->string('estado', 50);
            $table->string('producto', 200);
            $table->double('superficie_sembrada', 16, 2);
            $table->double('superficie_siniestrada', 16, 2);
            $table->double('superficie_cosechada', 16, 2);
            $table->double('produccion_obtenida', 16, 2);
            $table->double('rendimiento_obtenida', 16, 2);
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
        Schema::drop('agricola_siaps');
    }
}
