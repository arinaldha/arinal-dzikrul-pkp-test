<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => '$2y$12$oTFjyq9HFdh0fdwWkZ4./epS8mWwiORglG6FfO2wun.LHXvnq3Lj2',
            'created_at' => now()
        ]);
    }
}
