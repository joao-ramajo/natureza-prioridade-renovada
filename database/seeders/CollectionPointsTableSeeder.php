<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('collection_points')->insert([
            [
                'name' => 'Ponto A',
                'cep' => '12345678',
                'user_id' => 1,
                'created_at' => now()
            ]
        ]);
    }
}
