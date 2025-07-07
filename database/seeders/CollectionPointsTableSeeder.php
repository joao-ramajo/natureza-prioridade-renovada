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
                'name' => 'Ponto de Coleta Arburs',
                'cep' => '12345678',
                'street' => 'Rua das Flores',
                'number' => '123',
                'complement' => '',
                'neighborhood' => 'Liberdade',
                'city' => 'São Paulo',
                'state' => 'SP',
                'user_id' => 1,
                'open_from' => '08:00',
                'open_to' => '18:00',
                'days_open' => 'Seg - Sex - Sab',
                'description' => 'Ponto de coleta para recicláveis diversos.',
                'latitude' => -23.55052,
                'longitude' => -46.633308,
                'created_at' => now(),
            ],
            [
                'name' => 'Coleta Recicla Liberdade',
                'cep' => '01504000',
                'street' => 'Rua da Glória',
                'number' => '320',
                'complement' => 'Em frente ao metrô',
                'neighborhood' => 'Liberdade',
                'city' => 'São Paulo',
                'state' => 'SP',
                'user_id' => 1,
                'open_from' => '09:00',
                'open_to' => '19:00',
                'days_open' => 'Seg - Sab',
                'description' => 'Aceitamos papel, plástico e vidro.',
                'latitude' => -23.564415,
                'longitude' => -46.631732,
                'created_at' => now(),
            ],
            [
                'name' => 'Eco Ponto Vila Mariana',
                'cep' => '04107000',
                'street' => 'Avenida Professor Alfonso Bovero',
                'number' => '600',
                'complement' => '',
                'neighborhood' => 'Vila Mariana',
                'city' => 'São Paulo',
                'state' => 'SP',
                'user_id' => 1,
                'open_from' => '07:00',
                'open_to' => '17:00',
                'days_open' => 'Seg - Sex',
                'description' => 'Ponto de coleta para resíduos eletrônicos e recicláveis.',
                'latitude' => -23.589234,
                'longitude' => -46.634502,
                'created_at' => now(),
            ],
            [
                'name' => 'Coleta Sustentável Pinheiros',
                'cep' => '05422000',
                'street' => 'Rua dos Pinheiros',
                'number' => '150',
                'complement' => 'Loja 5',
                'neighborhood' => 'Pinheiros',
                'city' => 'São Paulo',
                'state' => 'SP',
                'user_id' => 1,
                'open_from' => '10:00',
                'open_to' => '20:00',
                'days_open' => 'Ter - Sab',
                'description' => 'Focado em recicláveis e óleo de cozinha usado.',
                'latitude' => -23.561676,
                'longitude' => -46.682178,
                'created_at' => now(),
            ],
            [
                'name' => 'Recicla Vila Madalena',
                'cep' => '05435000',
                'street' => 'Rua Aspicuelta',
                'number' => '260',
                'complement' => '',
                'neighborhood' => 'Vila Madalena',
                'city' => 'São Paulo',
                'state' => 'SP',
                'user_id' => 1,
                'open_from' => '08:00',
                'open_to' => '18:00',
                'days_open' => 'Seg - Dom',
                'description' => 'Ponto para coleta de papel, plástico e vidro.',
                'latitude' => -23.561013,
                'longitude' => -46.685653,
                'created_at' => now(),
            ],
        ]);
    }
}
