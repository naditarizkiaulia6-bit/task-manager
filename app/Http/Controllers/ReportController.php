<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $projects = $user->projects;
        
        // Get all tasks for user's projects
        $allTasks = $projects->with('tasks')->get()->pluck('tasks')->flatten();

        $stats = [
            'total' => $allTasks->count(),
            'completed' => $allTasks->where('status', 'done')->count(),
            'inProgress' => $allTasks->where('status', 'progress')->count(),
            'overdue' => $allTasks->where('due_date', '<', now())->where('status', '!=', 'done')->count(),
            'byStatus' => $allTasks->groupBy('status')->map->count(),
            'byPriority' => $allTasks->groupBy('priority')->map->count(),
            'byCategory' => $allTasks->groupBy('category')->map->count(),
        ];

        return view('reports.index', compact('stats', 'allTasks'));
    }
}
