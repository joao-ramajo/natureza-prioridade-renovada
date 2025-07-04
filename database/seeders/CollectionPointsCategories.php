<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionPointsCategories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('collection_point_category')->insert([
            [
                'collection_point_id' => 1,
                'category_id' => 1,
                // 'created_at' => now()
            ],
            [
                'collection_point_id' => 1,
                'category_id' => 2,
                // 'created_at' => now()
            ],
            [
                'collection_point_id' => 1,
                'category_id' => 3,
                // 'created_at' => now()
            ],
        ]);
    }
}
