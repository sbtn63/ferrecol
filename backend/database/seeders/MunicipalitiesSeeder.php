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
        /* Municipality::create([
            'name' => 'Tunja',
            'departament_id' => 1
        ]);

        Municipality::create([
            'name' => 'Zipaquira',
            'departament_id' => 2
        ]); */

        $municipalities = [
            ['name' => 'Bogotá', 'departament_id' => 2],
            ['name' => 'Cajicá', 'departament_id' => 2],
            ['name' => 'Chía', 'departament_id' => 2],
            ['name' => 'Facatativá', 'departament_id' => 2],
            ['name' => 'Sibaté', 'departament_id' => 2],
            ['name' => 'Soacha', 'departament_id' => 2],
            ['name' => 'Duitama', 'departament_id' => 1],
            ['name' => 'Sogamoso', 'departament_id' => 1],
            ['name' => 'Paipa', 'departament_id' => 1],
            ['name' => 'Chiquinquirá', 'departament_id' => 1],
            ['name' => 'Villa de Leyva', 'departament_id' => 1],
            ['name' => 'Chusacá', 'departament_id' => 2],
            ['name' => 'El Charquito', 'departament_id' => 2]
        ];

        Municipality::insert($municipalities);
    }
}
