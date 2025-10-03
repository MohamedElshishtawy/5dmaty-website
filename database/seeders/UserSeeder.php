<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test Client',
            'email' => 'test@t.com',
            'phone' => '01025315186',
            'address' => 'Nasr City, Cairo, Egypt',
        ])->assignRole('client');

        $super_admin = User::factory()->create([
            'name' => 'super admin',
            'email' => 'me@m.com',
            'phone' => '01093033115',
            'address' => 'Nasr City, Cairo, Egypt'
        ]);

        $super_admin->assignRole('superadmin');

    }
}
