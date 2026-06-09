<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Member users
        $members = [
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com'],
            ['name' => 'Ahmad Wijaya', 'email' => 'ahmad@example.com'],
            ['name' => 'Rinto Harahap', 'email' => 'rinto@example.com'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti@example.com'],
            ['name' => 'Dina Kusuma', 'email' => 'dina@example.com'],
        ];

        foreach ($members as $member) {
            User::create([
                'name' => $member['name'],
                'email' => $member['email'],
                'password' => Hash::make('password'),
                'role' => 'member',
            ]);
        }
    }
}
