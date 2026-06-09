<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagControllerRawSQL;
use App\Http\Controllers\TagControllerQueryBuilder;
use App\Models\User;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('tasks.index');
    }
    return view('auth.login');
});

// Public routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
})->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => 'member',
    ]);

    // Create default project for user
    $user->projects()->create([
        'name' => 'Project Saya',
        'description' => 'Proyek default untuk memulai',
    ]);

    auth()->login($user);

    return redirect()->route('tasks.index');
})->name('register.post');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    // Tasks
    Route::resource('tasks', TaskController::class)->only(['index', 'store', 'update', 'destroy', 'show', 'edit']);

    // Projects
    Route::resource('projects', ProjectController::class);

    // Comments
    Route::post('tasks/{task}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

    // Tags - Raw SQL CRUD
    Route::prefix('tags/raw-sql')->name('tags.raw-sql.')->group(function () {
        Route::get('/', [TagControllerRawSQL::class, 'index'])->name('index');
        Route::get('/create', [TagControllerRawSQL::class, 'create'])->name('create');
        Route::post('/', [TagControllerRawSQL::class, 'store'])->name('store');
        Route::get('/{id}', [TagControllerRawSQL::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TagControllerRawSQL::class, 'edit'])->name('edit');
        Route::put('/{id}', [TagControllerRawSQL::class, 'update'])->name('update');
        Route::delete('/{id}', [TagControllerRawSQL::class, 'destroy'])->name('destroy');
        Route::post('/search', [TagControllerRawSQL::class, 'search'])->name('search');
        Route::get('/api/statistics', [TagControllerRawSQL::class, 'statistics'])->name('statistics');
    });

    // Tags - Query Builder CRUD
    Route::prefix('tags/query-builder')->name('tags.query-builder.')->group(function () {
        Route::get('/', [TagControllerQueryBuilder::class, 'index'])->name('index');
        Route::get('/create', [TagControllerQueryBuilder::class, 'create'])->name('create');
        Route::post('/', [TagControllerQueryBuilder::class, 'store'])->name('store');
        Route::get('/{id}', [TagControllerQueryBuilder::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TagControllerQueryBuilder::class, 'edit'])->name('edit');
        Route::put('/{id}', [TagControllerQueryBuilder::class, 'update'])->name('update');
        Route::delete('/{id}', [TagControllerQueryBuilder::class, 'destroy'])->name('destroy');
        Route::get('/api/statistics', [TagControllerQueryBuilder::class, 'statistics'])->name('statistics');
        Route::post('/api/search', [TagControllerQueryBuilder::class, 'search'])->name('search');
    });
});
