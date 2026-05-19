<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
       'name' => 'Usuario Demo',
       'email' => 'demo@example.com',
       'password' => bcrypt('password'),
       ]);
    }
}
