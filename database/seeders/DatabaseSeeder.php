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
            'email' => 'subirosoriol@gmail.com',
            'password' => '123456789',
        ]);
    
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '123456789',
            'role' => 'admin',
        ]);

        $this->call(TipusSeeder::class);
        $this->call(ParkingSeeder::class);
        $this->call(ZonaSeeder::class);


    }
}
