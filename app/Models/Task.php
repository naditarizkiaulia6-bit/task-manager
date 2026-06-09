<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'assignee_id',
        'title',
        'description',
        'category',
        'priority',
        'status',
        'due_date',
        'progress',
    ];

    protected $casts = [
        'due_date' => 'date',
        'progress' => 'integer',
    ];

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Accessors
    public function getCategoryColorAttribute(): string
    {
        return match($this->category) {
            'design' => 'purple',
            'dev' => 'blue',
            'bug' => 'red',
            'research' => 'green',
            default => 'gray',
        };
    }

    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'high' => 'red',
            'medium' => 'yellow',
            'low' => 'green',
            default => 'gray',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'todo' => 'Belum Mulai',
            'progress' => 'Sedang Dikerjakan',
            'review' => 'Review',
            'done' => 'Selesai',
            default => 'Unknown',
        };
    }

    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'design' => 'Desain',
            'dev' => 'Pengembangan',
            'bug' => 'Bug',
            'research' => 'Riset',
            default => 'Unknown',
        };
    }

    public function getPriorityLabelAttribute(): string
    {
        return match($this->priority) {
            'high' => 'Tinggi',
            'medium' => 'Sedang',
            'low' => 'Rendah',
            default => 'Unknown',
        };
    }
}
