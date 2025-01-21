<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CotxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('cotxes')->insert([
            'matricula' => '1234-ABC',
            'marca_cotxe' => 'Toyota',
            'model_cotxe' => 'Corolla',
            'user_id' => 1,
        ]);
    }
}
