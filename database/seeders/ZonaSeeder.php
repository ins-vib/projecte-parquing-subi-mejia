<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $zonesPerParking = [
            1 => [ 
                ['nom' => 'Planta 1', 'capacitatTotal' => 100, 'estat' => true],
                ['nom' => 'Planta 2', 'capacitatTotal' => 100, 'estat' => true],
            ],
            2 => [ 
                ['nom' => 'Planta 1', 'capacitatTotal' => 75, 'estat' => true],
                ['nom' => 'Planta 2', 'capacitatTotal' => 75, 'estat' => true],
            ],
            3 => [ 
                ['nom' => 'Planta 1', 'capacitatTotal' => 150, 'estat' => true],
                ['nom' => 'Planta 2', 'capacitatTotal' => 150, 'estat' => true],
            ],
            4 => [ 
                ['nom' => 'Planta 1', 'capacitatTotal' => 60, 'estat' => true],
                ['nom' => 'Planta 2', 'capacitatTotal' => 60, 'estat' => false],
            ],
            5 => [ 
                ['nom' => 'Planta 1', 'capacitatTotal' => 125, 'estat' => true],
                ['nom' => 'Planta 2', 'capacitatTotal' => 125, 'estat' => true],
            ],
            6 => [ 
                ['nom' => 'Planta 1', 'capacitatTotal' => 90, 'estat' => true],
                ['nom' => 'Planta 2', 'capacitatTotal' => 90, 'estat' => true],
            ],
            7 => [ 
                ['nom' => 'Planta 1', 'capacitatTotal' => 50, 'estat' => true],
                ['nom' => 'Planta 2', 'capacitatTotal' => 50, 'estat' => true],
            ],
            8 => [ 
                ['nom' => 'Planta 1', 'capacitatTotal' => 110, 'estat' => true],
                ['nom' => 'Planta 2', 'capacitatTotal' => 110, 'estat' => true],
            ],
            9 => [ 
                ['nom' => 'Planta 1', 'capacitatTotal' => 90, 'estat' => true],
            ],
            10 => [ 
                ['nom' => 'Planta 1', 'capacitatTotal' => 250, 'estat' => true],
                ['nom' => 'Planta 2', 'capacitatTotal' => 250, 'estat' => true],
            ],
        ];

        foreach ($zonesPerParking as $parkingId => $zones) {
            foreach ($zones as $zone) {
                DB::table('zonas')->insert([
                    'nom' => $zone['nom'],
                    'capacitatTotal' => $zone['capacitatTotal'],
                    'estat' => $zone['estat'],
                    'parking_id' => $parkingId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);  
            }
        }
    }
}
