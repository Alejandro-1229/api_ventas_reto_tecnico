<?php

namespace Database\Seeders;

use App\Models\TypeOfId;
use Illuminate\Database\Seeder;

class TypeOfIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeOfId::create(['type_of_id_user' => 'DNI']);
        TypeOfId::create(['type_of_id_user' => 'RUC']);
    }
}
