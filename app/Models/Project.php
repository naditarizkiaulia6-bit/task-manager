<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function tasksByStatus()
    {
        return $this->tasks()
            ->orderBy('status')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('status');
    }

    // Statistics
    public function getStatisticsAttribute()
    {
        $tasks = $this->tasks;

        return [
            'total' => $tasks->count(),
            'inProgress' => $tasks->where('status', 'progress')->count(),
            'completed' => $tasks->where('status', 'done')->count(),
            'highPriority' => $tasks->where('priority', 'high')->count(),
        ];
    }
}
