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
            // Ponto de Coleta 1 com categorias 1 a 3, por exemplo
            [
                'collection_point_id' => 1,
                'category_id' => 1,
            ],
            [
                'collection_point_id' => 1,
                'category_id' => 2,
            ],
            [
                'collection_point_id' => 1,
                'category_id' => 3,
            ],

            // Ponto de Coleta 2 com categorias 2 e 4
            [
                'collection_point_id' => 2,
                'category_id' => 2,
            ],
            [
                'collection_point_id' => 2,
                'category_id' => 4,
            ],

            // Ponto de Coleta 3 com categorias 1 e 5
            [
                'collection_point_id' => 3,
                'category_id' => 1,
            ],
            [
                'collection_point_id' => 3,
                'category_id' => 5,
            ],

            // Ponto de Coleta 4 com categorias 3, 4 e 6
            [
                'collection_point_id' => 4,
                'category_id' => 3,
            ],
            [
                'collection_point_id' => 4,
                'category_id' => 4,
            ],
            [
                'collection_point_id' => 4,
                'category_id' => 6,
            ],

            // Ponto de Coleta 5 com categorias 5 e 6
            [
                'collection_point_id' => 5,
                'category_id' => 5,
            ],
            [
                'collection_point_id' => 5,
                'category_id' => 6,
            ],
        ]);
    }
}
