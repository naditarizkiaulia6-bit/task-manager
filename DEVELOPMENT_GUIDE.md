# Development Guide - Task Manager

## Project Architecture

### MVC Pattern
```
Models (app/Models/)
    ↓
Controllers (app/Http/Controllers/)
    ↓
Views (resources/views/)
```

### Technology Stack
- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Template Engine
- **Styling**: Tailwind CSS 3.4
- **Interactivity**: Alpine.js 3.13
- **Build Tool**: Vite 5.0
- **Package Manager**: Composer & npm

## File Organization

### Backend Files

#### Model: `app/Models/Task.php`
Handles:
- Database schema definition
- Data validation
- Accessor methods for colors and labels
- Relationships (if extended)

Key methods:
- `getCategoryColorAttribute()` - Returns color class for category
- `getPriorityColorAttribute()` - Returns color class for priority
- `getStatusLabelAttribute()` - Returns translated status label

#### Controller: `app/Http/Controllers/TaskController.php`
Handles:
- `index()` - Fetch & group tasks by status
- `store()` - Validate & save new task
- `update()` - Update task properties
- `destroy()` - Delete task

#### Migration: `database/migrations/create_tasks_table.php`
Defines:
- Tasks table structure
- Column types & constraints
- Enum constraints for categories, priorities, statuses

### Frontend Files

#### Layout: `resources/views/layouts/app.blade.php`
Provides:
- Base HTML structure
- Sidebar navigation
- Topbar with search & add button
- Modal template for adding tasks
- Alpine.js integration

#### Views
- `resources/views/tasks/index.blade.php` - Kanban board layout
- `resources/views/tasks/card.blade.php` - Reusable task card component

#### Styles: `resources/css/app.css`
Contains:
- Tailwind directives
- Custom component utilities
- Typography & spacing adjustments
- Scrollbar styling

#### Scripts: `resources/js/app.js`
Minimal JavaScript:
- Alpine.js initialization
- Axios bootstrap (optional)

## Development Workflow

### 1. Adding a New Feature

#### Step 1: Database Migration
```bash
php artisan make:migration add_new_field_to_tasks
```

Edit migration file and run:
```bash
php artisan migrate
```

#### Step 2: Update Model
Add new field to `$fillable` array:
```php
protected $fillable = [
    'title',
    'new_field', // Add here
];
```

#### Step 3: Update Controller
Add validation in `store()` or `update()` method:
```php
'new_field' => 'required|string|max:255',
```

#### Step 4: Update Views
Add form field in modal or update card component.

### 2. Modifying Styles

#### Tailwind CSS Classes
All styling uses Tailwind utility classes:
```blade
<!-- Background color -->
<div class="bg-indigo-500">

<!-- Padding -->
<div class="p-6">

<!-- Flexbox -->
<div class="flex items-center gap-3">

<!-- Responsive -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
```

#### Custom Components
Add reusable component utilities in `app.css`:
```css
@layer components {
  .btn-custom {
    @apply px-4 py-2 rounded-lg font-medium;
  }
}
```

### 3. Adding Alpine.js Interactivity

#### Basic Pattern
```blade
<div x-data="{ open: false }">
  <button @click="open = true">Open</button>
  
  <div x-show="open">
    Content here
  </div>
</div>
```

#### Common Directives
- `@click` - Click event
- `@submit.prevent` - Form submission
- `x-show` - Show/hide element
- `x-if` - Conditionally render
- `x-data` - Initialize Alpine component
- `x-model` - Two-way binding

### 4. Form Validation

#### Server-side (Laravel)
In controller:
```php
$validated = $request->validate([
    'title' => 'required|string|max:255',
    'priority' => 'in:low,medium,high',
    'due_date' => 'nullable|date|after:today',
]);
```

#### Client-side (HTML5)
```blade
<input type="text" name="title" required>
<input type="date" name="due_date">
<select name="priority" required>
    <option value="low">Rendah</option>
</select>
```

## Common Tasks

### Adding a New Status
1. Update migration enum:
```php
$table->enum('status', ['todo', 'progress', 'review', 'done', 'archived']);
```

2. Add to Model accessors:
```php
public function getStatusLabelAttribute(): string
{
    return match($this->status) {
        'archived' => 'Arsip',
        // ...
    };
}
```

3. Add column in Kanban board:
```blade
<div class="bg-slate-50 rounded-xl p-4">
  <h3>Arsip</h3>
  @foreach($tasksByStatus['archived'] as $task)
    @include('tasks.card', ['task' => $task])
  @endforeach
</div>
```

### Adding New Task Properties
1. **Migration**:
```php
$table->string('custom_field')->nullable();
```

2. **Model**:
```php
protected $fillable = ['custom_field'];
```

3. **Controller validation**:
```php
'custom_field' => 'nullable|string|max:100',
```

4. **View**:
```blade
<p class="text-sm">{{ $task->custom_field }}</p>
```

### Adding Search Functionality
```php
// In TaskController@index
$search = $request->input('search');

if ($search) {
    $tasks = Task::where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->get();
} else {
    $tasks = Task::all();
}
```

## Testing

### Unit Tests
Create test file:
```bash
php artisan make:test TaskTest
```

Example test:
```php
public function test_can_create_task()
{
    $response = $this->post('/tasks', [
        'title' => 'New Task',
        'category' => 'dev',
        'priority' => 'high',
    ]);

    $this->assertDatabaseHas('tasks', [
        'title' => 'New Task',
    ]);
}
```

Run tests:
```bash
php artisan test
```

### Manual Testing
Use Tinker for quick testing:
```bash
php artisan tinker
```

```php
# Create task
$task = Task::create([
    'title' => 'Test Task',
    'category' => 'dev',
    'priority' => 'high',
    'status' => 'todo',
]);

# Update task
$task->update(['status' => 'progress']);

# Get grouped tasks
Task::where('status', 'done')->count();
```

## Performance Tips

### Database Optimization
```php
// Use eager loading to prevent N+1 queries
$tasks = Task::with('relationships')->get();

// Use pagination for large datasets
$tasks = Task::paginate(15);

// Select specific columns
$tasks = Task::select('id', 'title', 'status')->get();
```

### Frontend Optimization
```blade
<!-- Use @forelse to handle empty state efficiently -->
@forelse($tasks as $task)
  <div>{{ $task->title }}</div>
@empty
  <p>No tasks</p>
@endforelse

<!-- Avoid repeated component rendering -->
@include('tasks.card', compact('task'))
```

### Caching
```php
// Cache frequently accessed data
Cache::remember('total_tasks', 3600, function () {
    return Task::count();
});
```

## Debugging

### Laravel Debugging
Use `dd()` (dump and die):
```php
dd($tasks);
```

Use `dump()` (dump without stopping):
```php
dump($tasks);
```

### Blade Debugging
```blade
<!-- Print variable -->
{{ dd($variable) }}

<!-- Log message -->
@php
  \Log::info('Debug message', ['data' => $variable]);
@endphp
```

### Browser Console
```javascript
// Alpine.js debugging
console.log($data);
```

## Deployment Checklist

- [ ] Update `.env` for production
- [ ] Run `php artisan key:generate`
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Seed data: `php artisan db:seed --force`
- [ ] Build assets: `npm run build`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Set correct `APP_URL` in `.env`
- [ ] Configure web server (Nginx/Apache)
- [ ] Setup SSL certificate
- [ ] Setup backups
- [ ] Configure monitoring

## Troubleshooting

### Issue: Migrations not working
```bash
php artisan migrate:refresh
php artisan migrate:fresh --seed
```

### Issue: Assets not updating
```bash
npm run build
npm run dev # for development
```

### Issue: Blade not rendering
Check:
- File extension is `.blade.php`
- View is in `resources/views/` directory
- Route returns correct view

### Issue: Alpine.js not working
- Ensure `<script defer src="...alpinejs..."></script>` is loaded
- Check browser console for errors
- Verify x-data syntax

## Best Practices

1. **Always validate input** - Both client and server side
2. **Use meaningful names** - Variables, functions, classes
3. **Comment complex logic** - Especially business rules
4. **Keep controllers lean** - Move logic to Models or Services
5. **Use migrations** - Never modify database directly
6. **Test before deploy** - Always test locally first
7. **Use version control** - Commit regularly with clear messages
8. **Security first** - Sanitize input, use CSRF tokens, escape output

## Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Blade Templating](https://laravel.com/docs/blade)
- [Tailwind CSS](https://tailwindcss.com/docs)
- [Alpine.js Documentation](https://alpinejs.dev/start-here)
- [Vite Documentation](https://vitejs.dev/)

