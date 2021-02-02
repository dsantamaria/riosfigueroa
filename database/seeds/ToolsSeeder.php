<?php

use Illuminate\Database\Seeder;
use App\Tool;

class ToolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tools = [
        	// ['name' => 'Importaciones', 'slug' => 'import', 'permissions' => 'import'],
        	// ['name' => 'AnalisisPrecios', 'slug' => 'price', 'permissions' => 'price'],
            // ['name' => 'AnalisisMercado', 'slug' => 'market', 'permissions' => 'market'],
            ['name' => 'AnalisisCultivo', 'slug' => 'cultivo', 'permissions' => 'cultivo'],
        ];

        foreach ($tools as $tool) {
        	Tool::firstOrCreate([
        		'name' => $tool['name'],
	            'slug' => $tool['slug'],
	            'permissions' => $tool['permissions']
	        ]);
        }
    }
}
