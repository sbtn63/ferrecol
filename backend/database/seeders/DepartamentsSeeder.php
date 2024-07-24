<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departament;

class DepartamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departaments = [
            ['name' => 'Boyaca'],
            ['name' => 'Cundinamarca']
        ];

        Departament::insert($departaments);
        //Departament::factory()->count(2)->create();
    }
}
