<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now(), // <- E-mail já verificado
                'created_at' => now(),
            ],
            [
                'name' => 'John Doe',
                'email' => 'john_doe@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => null, // <- E-mail não verificado
                'created_at' => now(),
            ],
        ]);
    }
}
