<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            StateSeeder::class,
            TypeOfIdSeeder::class
        ]);

        Product::factory()->count(100)->create();
        Client::factory()->count(200)->create();
        User::factory()->count(17)->create();
    }
}
