<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalysisImportListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_import_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('analysis_import_ingredient_id')->unsigned();
            $table->foreign('analysis_import_ingredient_id')->references('id')->on('analysis_import_ingredients')->onDelete('cascade');
            $table->string('year')->default('');
            $table->integer('trimestre')->default(0);
            $table->float('price')->default(0);
            $table->double('amount', 15, 8)->default(0);
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
        Schema::drop('analysis_import_lists');
    }
}
