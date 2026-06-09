<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CalendarController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $tasks = $user->projects()->with('tasks')->get()->pluck('tasks')->flatten();

        return view('calendar.index', compact('tasks'));
    }
}
