<?php

use Illuminate\Database\Seeder;
use App\Farm;

class FarmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farms = [
            'Agave',
            'Aguacate',
            'Ajo',
            'Alfalfa (T)',
            'Algodón',
            'Arándanos',
            'Arroz',
            'Avena Grano',
            'Berenjena',
            'Brócoli',
            'Cacahuate',
            'Cacao',
            'Café',
            'Calabacita',
            'Cana de Azúcar',
            'Cebolla',
            'Chícharo',
            'Chile verde',
            'Clavel',
            'Col (repollo)',
            'Crisantemo',
            'Durazno',
            'Espárrago',
            'Frambuesa',
            'Fresa',
            'Frijol',
            'Gladiola',
            'Lechuga',
            'Limón',
            'Maíz grano',
            'Mango',
            'Manzana',
            'Melón',
            'Naranja',
            'Nogal (Nuez)',
            'Palma de aceite',
            'Papa ',
            'Papaya',
            'Pastos y Praderas',
            'Pepino',
            'Piña',
            'Plátano',
            'Rosas (Gruesa)',
            'Sandía',
            'Sorgo Grano',
            'Soya',
            'Tabaco',
            'Tomate (Jitomate)',
            'Tomate Verde',
            'Toronja (pomelo)',
            'Trigo Grano',
            'Uva',
            'Zanahoria',
            'Zarzamora'
        ];

        foreach ($farms as $farm) {
        	Farm::firstOrCreate([
	            'farm' => $farm,
	        ]);
        }
    }
}
