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
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => now()
            ],
            [
                'username' => 'john@doe',
                'name' => 'John Doe',
                'email' => 'john_doe@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => now()
            ],
            ]);
    }
}
