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
                'name' => 'Collection Point A',
                'cep' => '12345678',
                'street' => 'Example Street',
                'number' => '123',
                'complement' => 'Apt 45',
                'neighborhood' => 'Downtown',
                'city' => 'São Paulo',
                'state' => 'SP',
                'user_id' => 1,
                'open_from' => '08:00',
                'open_to' => '18:00',
                'days_open' => 'Monday to Friday',
                'description' => 'Lorem ipsum dolor sit amet',
                'latitude' => -23.55052,
                'longitude' => -46.633308,
                'created_at' => now(),
                
            ]
        ]);
    }
}
