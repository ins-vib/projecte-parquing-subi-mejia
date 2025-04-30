<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tipusplaçes;

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

        $tipusPlaçes = Tipusplaçes::all()->keyBy('nom');

        foreach ($zones as $zone) {
            for ($i = 1; $i <= $zone['capacitat']; $i++) {
                if ($i % 10 < 6) {
                    $tipus = 'coche';
                } elseif ($i % 10 < 9) {
                    $tipus = 'moto';
                } else {
                    $tipus = 'other';
                }

                $tipusId = $tipusPlaçes->get($tipus)->id;

                $plazas[] = [
                    'numero' => $i,
                    'tipus_id' => $tipusId,
                    'estat' => true,
                    'zona_id' => $zone['id'],
                ];
            }
        }

        DB::table('plazas')->insert($plazas);
    }
}
