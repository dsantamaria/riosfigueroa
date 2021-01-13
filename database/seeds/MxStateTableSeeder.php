<?php

use Illuminate\Database\Seeder;
use App\MexicoState;

class MxStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['alias' => 'MX-AGU', 'name' => 'Aguascalientes'],
            ['alias' => 'MX-BCN', 'name' => 'Baja California'],
            ['alias' => 'MX-BCS', 'name' => 'Baja California Sur'],
            ['alias' => 'MX-CAM', 'name' => 'Campeche'],
            ['alias' => 'MX-CHP', 'name' => 'Chiapas'],
            ['alias' => 'MX-CHH', 'name' => 'Chihuahua'],
            ['alias' => 'MX-CMX', 'name' => 'Ciudad de México'],
            ['alias' => 'MX-COA', 'name' => 'Coahuila'],
            ['alias' => 'MX-COL', 'name' => 'Colima'],
            ['alias' => 'MX-DUR', 'name' => 'Durango'],
            ['alias' => 'MX-GUA', 'name' => 'Guanajuato'],
            ['alias' => 'MX-GRO', 'name' => 'Guerrero'],
            ['alias' => 'MX-HID', 'name' => 'Hidalgo'],
            ['alias' => 'MX-JAL', 'name' => 'Jalisco'],
            ['alias' => 'MX-MIC', 'name' => 'Michoacán'],
            ['alias' => 'MX-MOR', 'name' => 'Morelos'],
            ['alias' => 'MX-MEX', 'name' => 'México'],
            ['alias' => 'MX-NAY', 'name' => 'Nayarit'],
            ['alias' => 'MX-NLE', 'name' => 'Nuevo León'],
            ['alias' => 'MX-OAX', 'name' => 'Oaxaca'],
            ['alias' => 'MX-PUE', 'name' => 'Puebla'],
            ['alias' => 'MX-QUE', 'name' => 'Querétaro'],
            ['alias' => 'MX-ROO', 'name' => 'Quintana Roo'],
            ['alias' => 'MX-SLP', 'name' => 'San Luis Potosí'],
            ['alias' => 'MX-SIN', 'name' => 'Sinaloa'],
            ['alias' => 'MX-SON', 'name' => 'Sonora'],
            ['alias' => 'MX-TAB', 'name' => 'Tabasco'],
            ['alias' => 'MX-TAM', 'name' => 'Tamaulipas'],
            ['alias' => 'MX-TLA', 'name' => 'Tlaxcala'],
            ['alias' => 'MX-VER', 'name' => 'Veracruz'],
            ['alias' => 'MX-YUC', 'name' => 'Yucatán'],
            ['alias' => 'MX-ZAC', 'name' => 'Zacatecas']
        ];

        foreach ($states as $state) {
        	MexicoState::firstOrCreate([
                'name' => $state['name'],
                'alias' => $state['alias'],
	        ]);
        }
    }
}
