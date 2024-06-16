<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;

class MunicipalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Municipality::create([
            'name' => 'Tunja',
            'departament_id' => 2
        ]);

        Municipality::create([
            'name' => 'Zipaquira',
            'departament_id' => 1
        ]);
    }
}
