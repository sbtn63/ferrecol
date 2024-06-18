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
        TrainStation::create([
            "name" => 'Estación de Tunja Norte',
            "municipality_id" => 1
        ]);

        TrainStation::create([
            "name" => 'Estación de Zipaquirá',
            "municipality_id" => 2
        ]);
    }
}
