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

        DB::table('zonas')->insert([
            'nom' => 'Zona A',
            'capacitatTotal' => 50,
            'estat' => true,
            'parking_id' => 1,
        ]);

    }
}
