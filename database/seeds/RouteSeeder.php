<?php

use Illuminate\Database\Seeder;
use App\Route;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = [
        	'Buscador de Productos',
        	'Listado de Productos',
        	'Analisis de Importaciones',
        	'Empresas Comercializadoras',
        	'Analisis de Precios - Promedio General',
        	'Analisis de Precios - Precio Mínimo',
        	'Analisis de Precios - Precio Máximo',
        	'Analisis de Precios - Mediana',
        	'Analisis de Precios - Análisis Cuartil',
        	'Analisis de Precios - Análisis Comparativo PE/PE',
        	'Analisis de Precios - Analisis Comparativo PE/PA',
        ];

        foreach ($routes as $value) {
        	Route::firstOrCreate([
	            'route' => $value,
	        ]);
        }
    }
}
