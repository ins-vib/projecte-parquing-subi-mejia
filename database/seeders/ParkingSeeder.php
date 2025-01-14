<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('parkings')->insert([
            [
                'name' => 'Parking Central',
                'address' => 'Carrer Major, 10',
                'ciutat' => 'Barcelona',
                'capacitat' => 200,
                'plaçes_ocupades' => 0,
                'latitud' => 41.3851,
                'longitud' => 2.1734,
                'horaObertura' => '07:00:00',
                'horaTancament' => '22:00:00',
                'num_plantes' => 2,
                'tipus_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Nord',
                'address' => 'Avinguda del Nord, 15',
                'ciutat' => 'Girona',
                'capacitat' => 150,
                'plaçes_ocupades' => 0,
                'latitud' => 41.9794,
                'longitud' => 2.8213,
                'horaObertura' => '06:30:00',
                'horaTancament' => '23:00:00',
                'num_plantes' => 1,
                'tipus_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Estació',
                'address' => 'Plaça de l\'Estació, 1',
                'ciutat' => 'Tarragona',
                'capacitat' => 300,
                'plaçes_ocupades' => 0,
                'latitud' => 41.1189,
                'longitud' => 1.2445,
                'horaObertura' => '05:00:00',
                'horaTancament' => '00:00:00',
                'num_plantes' => 2,
                'tipus_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
