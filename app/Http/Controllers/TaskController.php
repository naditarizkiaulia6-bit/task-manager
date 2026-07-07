<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(): View
    {
        // Jika admin, lihat semua projects dari semua members
        // Jika member, hanya lihat projects mereka sendiri
        
        if (auth()->user()->role === 'admin') {
            // Admin: Lihat semua projects dan tasks dari semua members
            $projects = Project::whereHas('user', function ($query) {
                $query->where('role', 'member');
            })->get();
            
            if ($projects->isEmpty()) {
                return view('tasks.empty');
            }
            
            // Aggregasi tasks dari semua projects
            $allTasks = Task::whereIn('project_id', $projects->pluck('id'))->get();
            
            $tasksByStatus = [
                'todo' => $allTasks->where('status', 'todo')->values(),
                'progress' => $allTasks->where('status', 'progress')->values(),
                'review' => $allTasks->where('status', 'review')->values(),
                'done' => $allTasks->where('status', 'done')->values(),
            ];

            $stats = [
                'total' => $allTasks->count(),
                'inProgress' => $allTasks->where('status', 'progress')->count(),
                'completed' => $allTasks->where('status', 'done')->count(),
                'highPriority' => $allTasks->where('priority', 'high')->count(),
            ];
            
            // Set project ke null karena admin tidak punya project
            $project = null;
        } else {
            // Member: Hanya lihat projects mereka sendiri
            $projects = auth()->user()->projects;
            $project = $projects->first();

            if (!$project) {
                return view('tasks.empty');
            }

            $tasks = $project->tasks;
            $tasksByStatus = [
                'todo' => $tasks->where('status', 'todo')->values(),
                'progress' => $tasks->where('status', 'progress')->values(),
                'review' => $tasks->where('status', 'review')->values(),
                'done' => $tasks->where('status', 'done')->values(),
            ];

            $stats = [
                'total' => $tasks->count(),
                'inProgress' => $tasks->where('status', 'progress')->count(),
                'completed' => $tasks->where('status', 'done')->count(),
                'highPriority' => $tasks->where('priority', 'high')->count(),
            ];
        }

        return view('tasks.index', compact('project', 'tasksByStatus', 'stats'));
    }

    public function store(Request $request)
    {
        $project = auth()->user()->projects()->first();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|in:design,dev,bug,research',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        $validated['project_id'] = $project->id;
        $validated['status'] = 'todo';
        $validated['progress'] = 0;

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function update(Request $request, Task $task)
    {
        // Check if this is a quick status update from kanban or a full edit
        if ($request->has('status') && !$request->has('title')) {
            // Quick status update only
            $validated = $request->validate([
                'status' => 'in:todo,progress,review,done',
            ]);
            $task->update($validated);
            return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui!');
        }

        // Full update from edit form
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|in:design,dev,bug,research',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,progress,review,done',
            'progress' => 'integer|min:0|max:100',
            'due_date' => 'nullable|date',
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.show', $task)->with('success', 'Tugas berhasil diperbarui!');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus!');
    }
}
