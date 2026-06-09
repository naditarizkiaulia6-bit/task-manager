<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = Task::all();
        $users = User::where('role', 'member')->get();

        foreach ($tasks->take(5) as $task) {
            Comment::create([
                'task_id' => $task->id,
                'user_id' => $users->random()->id,
                'body' => 'Tugas ini sedang kami kerjakan dengan baik.',
            ]);

            Comment::create([
                'task_id' => $task->id,
                'user_id' => $users->random()->id,
                'body' => 'Ada kendala pada bagian ini, perlu di-review lebih lanjut.',
            ]);
        }
    }
}
