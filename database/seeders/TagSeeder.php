<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        // Sample tags
        $tags = [
            ['name' => 'Frontend', 'color' => 'blue', 'description' => 'Frontend development tasks'],
            ['name' => 'Backend', 'color' => 'purple', 'description' => 'Backend development tasks'],
            ['name' => 'Database', 'color' => 'indigo', 'description' => 'Database related tasks'],
            ['name' => 'Testing', 'color' => 'green', 'description' => 'Testing and QA tasks'],
            ['name' => 'Urgent', 'color' => 'red', 'description' => 'Urgent priority tasks'],
            ['name' => 'Documentation', 'color' => 'gray', 'description' => 'Documentation tasks'],
            ['name' => 'Design', 'color' => 'pink', 'description' => 'UI/UX design tasks'],
            ['name' => 'Optimization', 'color' => 'yellow', 'description' => 'Performance optimization'],
        ];

        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag['name'],
                'color' => $tag['color'],
                'description' => $tag['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
