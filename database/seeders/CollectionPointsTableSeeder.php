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
                'open_from' => '08:00',
                'open_to' => '18:00',
                'days_open' => 'Segunda a sexta',
                'description' => 'Lorem ipslum dolor amet',
                'created_at' => now()
            ]
        ]);
    }
}
