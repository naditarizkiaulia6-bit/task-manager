<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
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
        $validated = $request->validate([
            'status' => 'in:todo,progress,review,done',
            'priority' => 'in:low,medium,high',
            'progress' => 'integer|min:0|max:100',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui!');
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
