<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed a test user with a valid Egyptian phone number for auth testing
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '01123456789',
            'address' => 'Nasr City, Cairo, Egypt',
            // password defaults to 'password' via factory
        ]);
    }
}
