<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // 2. Akun Content Manager
        User::create([
            'name' => 'Content Manager',
            'email' => 'manager@test.com',
            'role' => 'content_manager',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }
}
