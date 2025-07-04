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
            ['name' => 'Ecológico'],
            ['name' => 'Reciclável'],
            ['name' => 'Não reciclável'],
            ['name' => 'Perigoso'],
            ['name' => 'Eletrônico'],
            ['name' => 'Hospitalar'],
            ['name' => 'Radioativo'],
            ['name' => 'Construção Civil'],
            ['name' => 'Pneus'],
            ['name' => 'Óleo usado'],
        ]);
    }
}
