<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Oriol Subiros',
            'email' => 'subiros@subiros.com',
            'password' => '123456789',
        ]);

        User::factory()->create([
            'name' => 'Daniel Mejia',
            'email' => 'daniel@daniel.com',
            'password' => '123456789',
        ]);
    
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '123456789',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Operador',
            'email' => 'operador@operador.com',
            'password' => '123456789',
            'role' => 'operador',
        ]);

        $this->call(TipusSeeder::class);
        $this->call(TarifaSeeder::class);
        $this->call(ParkingSeeder::class);
        $this->call(ZonaSeeder::class);
        $this->call(PlazaSeeder::class);


    }
}
