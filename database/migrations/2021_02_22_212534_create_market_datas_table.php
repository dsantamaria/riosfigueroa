<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entidadid');
            $table->foreign('entidadid')->references('id')->on('market_entity')->onDelete('cascade');
            $table->unsignedInteger('cicloid');
            $table->foreign('cicloid')->references('id')->on('market_cicle')->onDelete('cascade');
            $table->unsignedInteger('tecnologiaid');
            $table->foreign('tecnologiaid')->references('id')->on('market_technology')->onDelete('cascade');
            $table->integer('ano');
            $table->bigInteger('supsembrada');
            $table->bigInteger('supcocechada');
            $table->bigInteger('supsiniestrada');
            $table->bigInteger('produccion');
            $table->bigInteger('rendimiento');
            $table->bigInteger('pmr');
            $table->bigInteger('valorpesos');
            $table->unsignedInteger('modalidadid');
            $table->foreign('modalidadid')->references('id')->on('market_modality')->onDelete('cascade');
            $table->unsignedInteger('cultivoid');
            $table->foreign('cultivoid')->references('id')->on('market_farm')->onDelete('cascade');
            $table->integer('medidaid');
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
        Schema::drop('market_datas');
    }
}
