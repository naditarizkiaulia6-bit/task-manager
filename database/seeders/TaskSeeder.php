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
        $project = Project::first();
        $users = User::where('role', 'member')->get();

        $tasks = [
            [
                'title' => 'Desain UI Dashboard',
                'description' => 'Membuat design mockup untuk dashboard admin dengan Figma',
                'category' => 'design',
                'priority' => 'high',
                'status' => 'todo',
                'due_date' => Carbon::now()->addDays(5),
                'assignee_id' => $users[0]->id,
                'progress' => 0,
            ],
            [
                'title' => 'Setup Database Server',
                'description' => 'Konfigurasi PostgreSQL database di server production',
                'category' => 'dev',
                'priority' => 'high',
                'status' => 'todo',
                'due_date' => Carbon::now()->addDays(3),
                'assignee_id' => $users[1]->id,
                'progress' => 0,
            ],
            [
                'title' => 'Implementasi API Login',
                'description' => 'Membuat endpoint login dengan JWT authentication',
                'category' => 'dev',
                'priority' => 'high',
                'status' => 'progress',
                'due_date' => Carbon::now()->addDays(2),
                'assignee_id' => $users[2]->id,
                'progress' => 75,
            ],
            [
                'title' => 'Fix Bug Responsive Mobile',
                'description' => 'Memperbaiki layout yang tidak responsive di halaman produk',
                'category' => 'bug',
                'priority' => 'medium',
                'status' => 'progress',
                'due_date' => Carbon::now()->addDays(1),
                'assignee_id' => $users[3]->id,
                'progress' => 50,
            ],
            [
                'title' => 'Riset Teknologi AI',
                'description' => 'Melakukan riset tentang implementasi Machine Learning untuk rekomendasi produk',
                'category' => 'research',
                'priority' => 'medium',
                'status' => 'progress',
                'due_date' => Carbon::now()->addDays(7),
                'assignee_id' => $users[4]->id,
                'progress' => 30,
            ],
            [
                'title' => 'Optimasi Performance Database',
                'description' => 'Mengoptimalkan query dan indexing untuk mengurangi query time',
                'category' => 'dev',
                'priority' => 'medium',
                'status' => 'review',
                'due_date' => Carbon::now()->addDays(0),
                'assignee_id' => $users[0]->id,
                'progress' => 95,
            ],
            [
                'title' => 'Design Banner Promo',
                'description' => 'Membuat design banner untuk campaign promo Ramadhan',
                'category' => 'design',
                'priority' => 'low',
                'status' => 'review',
                'due_date' => Carbon::now()->addDays(1),
                'assignee_id' => $users[1]->id,
                'progress' => 85,
            ],
            [
                'title' => 'Setup CI/CD Pipeline',
                'description' => 'Konfigurasi GitHub Actions untuk automated deployment',
                'category' => 'dev',
                'priority' => 'high',
                'status' => 'done',
                'due_date' => Carbon::now()->subDays(2),
                'assignee_id' => $users[2]->id,
                'progress' => 100,
            ],
            [
                'title' => 'Fix Critical Security Bug',
                'description' => 'Memperbaiki SQL Injection vulnerability di halaman search',
                'category' => 'bug',
                'priority' => 'high',
                'status' => 'done',
                'due_date' => Carbon::now()->subDays(1),
                'assignee_id' => $users[3]->id,
                'progress' => 100,
            ],
            [
                'title' => 'Update Documentation',
                'description' => 'Memperbarui API documentation dengan endpoint terbaru',
                'category' => 'dev',
                'priority' => 'low',
                'status' => 'done',
                'due_date' => Carbon::now()->subDays(3),
                'assignee_id' => $users[4]->id,
                'progress' => 100,
            ],
        ];

        foreach ($tasks as $task) {
            $task['project_id'] = $project->id;
            Task::create($task);
        }
    }
}
