<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Ecológico', 'created_at' => now()],
            ['name' => 'Reciclável', 'created_at' => now()],
            ['name' => 'Não reciclável', 'created_at' => now()],
            ['name' => 'Perigoso', 'created_at' => now()],
            ['name' => 'Eletrônico', 'created_at' => now()],
            ['name' => 'Hospitalar', 'created_at' => now()],
            ['name' => 'Radioativo', 'created_at' => now()],
            ['name' => 'Construção Civil', 'created_at' => now()],
            ['name' => 'Pneus', 'created_at' => now()],
            ['name' => 'Óleo usado', 'created_at' => now()],
        ]);
    }
}
