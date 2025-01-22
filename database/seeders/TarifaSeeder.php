<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TarifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('tarifa')->insert([
            'id' => '1',
            'preu' => 2.50,
        ]);

        DB::table('tarifa')->insert([
            'id' => '2',
            'preu' => 2.75,
        ]);
    }
}
