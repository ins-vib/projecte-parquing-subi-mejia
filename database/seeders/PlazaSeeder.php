<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlazaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plazas = [];

        $zones = [
            ['id' => 1, 'nom' => 'Planta 1', 'capacitat' => 70],
            ['id' => 2, 'nom' => 'Planta 2', 'capacitat' => 70],
            ['id' => 3, 'nom' => 'Planta 1', 'capacitat' => 80, 'parking_id' => 2],
        ];

        foreach ($zones as $zone) {
            for ($i = 1; $i <= $zone['capacitat']; $i++) {
                $tipus = ($i % 10 < 6) ? 'coche' : (($i % 10 < 9) ? 'moto' : 'other');

                $plazas[] = [
                    'numero' => $i,
                    'tipus' => $tipus,
                    'estat' => true,
                    'zona_id' => $zone['id'],
                ];
            }
        }

        DB::table('plazas')->insert($plazas);
    }
}
