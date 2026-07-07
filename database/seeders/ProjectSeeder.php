<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya buat projects untuk 5 member users
        // Admin TIDAK memiliki projects (berperan sebagai koordinator)
        
        $members = User::where('role', 'member')->get();
        
        $projectData = [
            [
                'name' => 'E-commerce Website',
                'description' => 'Pengembangan platform e-commerce online store',
            ],
            [
                'name' => 'Mobile Banking App',
                'description' => 'Aplikasi mobile banking untuk nasabah',
            ],
            [
                'name' => 'Admin Dashboard',
                'description' => 'Dashboard untuk monitoring dan reporting',
            ],
            [
                'name' => 'API Gateway',
                'description' => 'Pengembangan API gateway untuk integrasi sistem',
            ],
            [
                'name' => 'Customer Portal',
                'description' => 'Portal pelanggan untuk self-service',
            ],
        ];

        foreach ($members as $index => $member) {
            Project::create([
                'user_id' => $member->id,
                'name' => $projectData[$index]['name'],
                'description' => $projectData[$index]['description'],
            ]);
        }
    }
}
