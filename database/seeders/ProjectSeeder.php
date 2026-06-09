<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        Project::create([
            'user_id' => $admin->id,
            'name' => 'Website Redesign 2024',
            'description' => 'Redesign website perusahaan dengan teknologi terbaru',
        ]);

        Project::create([
            'user_id' => $admin->id,
            'name' => 'Mobile App Development',
            'description' => 'Pengembangan aplikasi mobile untuk iOS dan Android',
        ]);

        Project::create([
            'user_id' => $admin->id,
            'name' => 'Dashboard Analytics',
            'description' => 'Pembuatan dashboard analytics real-time',
        ]);
    }
}
