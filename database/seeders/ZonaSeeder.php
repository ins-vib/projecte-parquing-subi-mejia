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
        DB::table('zonas')->insert([
            ['nom' => 'Planta 1', 'capacitatTotal' => 100, 'estat' => true, 'parking_id' => 1],
            ['nom' => 'Planta 2', 'capacitatTotal' => 100, 'estat' => true, 'parking_id' => 1],

            ['nom' => 'Planta 1', 'capacitatTotal' => 80, 'estat' => true, 'parking_id' => 2],
        ]);
    }
}
