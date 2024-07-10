<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TrainStation;

class TrainStationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* TrainStation::create([
            "name" => 'Estación de Tunja Norte',
            "municipality_id" => 1
        ]);

        TrainStation::create([
            "name" => 'Estación de Zipaquirá',
            "municipality_id" => 2
        ]); */

        TrainStation::insert([
            [
                'name' => 'Estación de la Sabana',
                'municipality_id' => 3, // Bogotá
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Zipaquirá',
                'municipality_id' => 2, // Zipaquira
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Cajicá',
                'municipality_id' => 4, // Cajicá
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Chía',
                'municipality_id' => 5, // Chía
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Facatativá',
                'municipality_id' => 6, // Facatativá
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Sibaté',
                'municipality_id' => 7, // Sibaté
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de La Caro',
                'municipality_id' => 5, // Chía
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Soacha',
                'municipality_id' => 8, // Soacha
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Tunja Norte',
                'municipality_id' => 1, // Tunja
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Tunja Sur',
                'municipality_id' => 1, // Tunja
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Duitama',
                'municipality_id' => 9, // Duitama
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Sogamoso',
                'municipality_id' => 10, // Sogamoso
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Paipa',
                'municipality_id' => 11, // Paipa
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Chiquinquirá',
                'municipality_id' => 12, // Chiquinquirá
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Villa de Leyva',
                'municipality_id' => 13, // Villa de Leyva
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Usaquén',
                'municipality_id' => 3, // Bogotá
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Fontibón',
                'municipality_id' => 3, // Bogotá
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de Chusacá',
                'municipality_id' => 14, // Chusacá
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Estación de El Charquito',
                'municipality_id' => 15, // El Charquito
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
