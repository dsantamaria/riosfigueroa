<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePreciosStrings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `products` MODIFY `precio_comercial` varchar(255) NOT NULL;');
        DB::statement('ALTER TABLE `products` MODIFY `precio_por_medida` varchar(255) NOT NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `products` MODIFY `precio_comercial` varchar(255) NOT NULL;');
        DB::statement('ALTER TABLE `products` MODIFY `precio_por_medida` varchar(255) NOT NULL;');
    }
}
