<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalysisPricesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_prices_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores_historics');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categoria_historics');
            $table->integer('analysis_category_price_id')->unsigned();
            $table->foreign('analysis_category_price_id')->references('id')->on('analysis_category_prices')->onDelete('cascade');
            $table->string('nombre_producto')->default('');;
            $table->string('ingrediente_activo')->default('');
            $table->string('tipo_producto')->default('');
            $table->string('formulacion')->default('');
            $table->string('concentracion')->default('0%');
            $table->string('presentacion')->default('');
            $table->string('unidad')->default('');
            $table->string('empaque')->default('');
            $table->string('impuesto')->default('0%');
            $table->float('precio_comercial')->default(0);
            $table->float('precio_por_medida')->default(0);
            $table->dateTime('ultima_actualizacion');
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
        Schema::drop('analysis_prices_products');
    }
}
