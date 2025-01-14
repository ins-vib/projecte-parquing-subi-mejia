<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        DB::table('tipusparking')->insert([
            [
                'id' => '1',
                'tipus' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'tipus' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',
                'tipus' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
