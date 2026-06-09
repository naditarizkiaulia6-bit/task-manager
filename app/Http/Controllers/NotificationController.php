<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(): View
    {
        $notifications = [];
        
        return view('notifications.index', compact('notifications'));
    }
}
