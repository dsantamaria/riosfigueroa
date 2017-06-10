<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUltimaActualizacionTypeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('ultima_actualizacion');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->date('ultima_actualizacion');
        });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('ultima_actualizacion');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dateTime('ultima_actualizacion');
        }); 
    }
}
