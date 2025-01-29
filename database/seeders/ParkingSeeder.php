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
        DB::table('parkings')->insert([
            [
                'name' => 'Parking Central',
                'address' => 'Carrer Major, 10',
                'ciutat' => 'Tarragona',
                'capacitat' => 200,
                'plaçes_ocupades' => 20,
                'latitud' => 41.1189,
                'longitud' => 1.2445,
                'horaObertura' => '06:00:00',
                'horaTancament' => '22:00:00',
                'num_plantes' => 2,
                'tipus_id' => 1,
                'tarifa_id' => 1,
            ],
            [
                'name' => 'Parking Rambla Nova',
                'address' => 'Rambla Nova, 50',
                'ciutat' => 'Tarragona',
                'capacitat' => 80,
                'plaçes_ocupades' => 0,
                'latitud' => 41.1200,
                'longitud' => 1.2510,
                'horaObertura' => '07:00:00',
                'horaTancament' => '23:00:00',
                'num_plantes' => 1,
                'tipus_id' => 2,
                'tarifa_id' => 2,
            ],
        ]);
    }
}
