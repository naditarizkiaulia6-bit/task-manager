<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $members = User::where('role', 'member')->get();

        // Sample tasks untuk setiap member project
        $taskTemplates = [
            // E-commerce Website
            [
                ['title' => 'Setup Database Schema', 'description' => 'Perancangan schema database untuk produk dan order', 'category' => 'dev', 'priority' => 'high', 'status' => 'todo', 'progress' => 0],
                ['title' => 'Frontend Homepage Design', 'description' => 'Membuat design homepage yang menarik', 'category' => 'design', 'priority' => 'high', 'status' => 'progress', 'progress' => 60],
                ['title' => 'Payment Gateway Integration', 'description' => 'Integrasi dengan payment gateway', 'category' => 'dev', 'priority' => 'high', 'status' => 'todo', 'progress' => 0],
            ],
            // Mobile Banking App
            [
                ['title' => 'UI/UX Design Mobile App', 'description' => 'Desain interface mobile banking', 'category' => 'design', 'priority' => 'high', 'status' => 'progress', 'progress' => 50],
                ['title' => 'Authentication System', 'description' => 'Implementasi sistem autentikasi dengan biometric', 'category' => 'dev', 'priority' => 'high', 'status' => 'todo', 'progress' => 0],
                ['title' => 'Testing & QA', 'description' => 'Testing aplikasi di berbagai devices', 'category' => 'research', 'priority' => 'medium', 'status' => 'todo', 'progress' => 0],
            ],
            // Admin Dashboard
            [
                ['title' => 'Dashboard Layout Setup', 'description' => 'Membuat layout dashboard dengan responsif', 'category' => 'dev', 'priority' => 'high', 'status' => 'progress', 'progress' => 75],
                ['title' => 'Chart Integration', 'description' => 'Integrasi library chart untuk visualisasi data', 'category' => 'dev', 'priority' => 'medium', 'status' => 'todo', 'progress' => 0],
                ['title' => 'API Documentation', 'description' => 'Membuat dokumentasi API lengkap', 'category' => 'dev', 'priority' => 'low', 'status' => 'todo', 'progress' => 0],
            ],
            // API Gateway
            [
                ['title' => 'API Design & Planning', 'description' => 'Merencanakan struktur dan design API', 'category' => 'research', 'priority' => 'high', 'status' => 'done', 'progress' => 100],
                ['title' => 'Authentication & Authorization', 'description' => 'Implementasi OAuth dan JWT', 'category' => 'dev', 'priority' => 'high', 'status' => 'progress', 'progress' => 80],
                ['title' => 'Rate Limiting & Monitoring', 'description' => 'Setup rate limiting dan monitoring API', 'category' => 'dev', 'priority' => 'medium', 'status' => 'todo', 'progress' => 0],
            ],
            // Customer Portal
            [
                ['title' => 'User Profile Page', 'description' => 'Membuat halaman profil user dengan edit functionality', 'category' => 'dev', 'priority' => 'medium', 'status' => 'progress', 'progress' => 40],
                ['title' => 'Ticket Support System', 'description' => 'Implementasi sistem tiket support', 'category' => 'dev', 'priority' => 'high', 'status' => 'todo', 'progress' => 0],
                ['title' => 'Notification System', 'description' => 'Membuat sistem notifikasi real-time', 'category' => 'dev', 'priority' => 'medium', 'status' => 'todo', 'progress' => 0],
            ],
        ];

        // Assign tasks ke setiap member project
        foreach ($members as $index => $member) {
            $project = $member->projects()->first();
            
            if ($project && isset($taskTemplates[$index])) {
                foreach ($taskTemplates[$index] as $taskData) {
                    $daysOffset = $taskData['status'] === 'done' ? -3 : ($taskData['status'] === 'progress' ? 1 : 3);
                    
                    Task::create([
                        'project_id' => $project->id,
                        'title' => $taskData['title'],
                        'description' => $taskData['description'],
                        'category' => $taskData['category'],
                        'priority' => $taskData['priority'],
                        'status' => $taskData['status'],
                        'progress' => $taskData['progress'],
                        'due_date' => Carbon::now()->addDays($daysOffset),
                        'assignee_id' => $member->id,
                    ]);
                }
            }
        }
    }
}
