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
                'latitud' => 41.3851,
                'longitud' => 2.1734,
                'horaObertura' => '07:00:00',
                'horaTancament' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Nord',
                'address' => 'Avinguda del Nord, 15',
                'ciutat' => 'Girona',
                'capacitat' => 150,
                'latitud' => 41.9794,
                'longitud' => 2.8213,
                'horaObertura' => '06:30:00',
                'horaTancament' => '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Estació',
                'address' => 'Plaça de l\'Estació, 1',
                'ciutat' => 'Tarragona',
                'capacitat' => 300,
                'latitud' => 41.1189,
                'longitud' => 1.2445,
                'horaObertura' => '05:00:00',
                'horaTancament' => '00:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Sud',
                'address' => 'Carrer Sud, 23',
                'ciutat' => 'Lleida',
                'capacitat' => 120,
                'latitud' => 41.6176,
                'longitud' => 0.6200,
                'horaObertura' => '08:00:00',
                'horaTancament' => '21:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Centre',
                'address' => 'Rambla Principal, 45',
                'ciutat' => 'Reus',
                'capacitat' => 250,
                'latitud' => 41.1561,
                'longitud' => 1.1069,
                'horaObertura' => '07:00:00',
                'horaTancament' => '22:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Platja',
                'address' => 'Passeig Marítim, 7',
                'ciutat' => 'Salou',
                'capacitat' => 180,
                'latitud' => 41.0766,
                'longitud' => 1.1311,
                'horaObertura' => '06:00:00',
                'horaTancament' => '01:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Montjuïc',
                'address' => 'Carrer de Montjuïc, 12',
                'ciutat' => 'Barcelona',
                'capacitat' => 100,
                'latitud' => 41.3697,
                'longitud' => 2.1603,
                'horaObertura' => '08:00:00',
                'horaTancament' => '20:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Olímpic',
                'address' => 'Avinguda Olímpica, 5',
                'ciutat' => 'Terrassa',
                'capacitat' => 220,
                'latitud' => 41.5632,
                'longitud' => 2.0085,
                'horaObertura' => '07:30:00',
                'horaTancament' => '23:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Universitat',
                'address' => 'Carrer Universitat, 3',
                'ciutat' => 'Vic',
                'capacitat' => 90,
                'latitud' => 41.9302,
                'longitud' => 2.2543,
                'horaObertura' => '07:00:00',
                'horaTancament' => '21:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parking Aeroport',
                'address' => 'Carrer Aeroport, 2',
                'ciutat' => 'El Prat de Llobregat',
                'capacitat' => 500,
                'latitud' => 41.2974,
                'longitud' => 2.0833,
                'horaObertura' => '00:00:00',
                'horaTancament' => '23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
