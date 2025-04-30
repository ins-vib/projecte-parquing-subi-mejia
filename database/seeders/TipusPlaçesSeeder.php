<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tipusplaçes;


class TipusPlaçesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipusplaçes::create(['nom' => 'coche']);
        Tipusplaçes::create(['nom' => 'moto']);
        Tipusplaçes::create(['nom' => 'other']);
    }

}
