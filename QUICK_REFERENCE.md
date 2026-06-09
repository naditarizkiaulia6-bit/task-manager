# Quick Reference - Task Manager

## 🚀 Quick Start Commands

```bash
# Setup
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=TaskSeeder

# Development
npm run dev
php artisan serve

# Production Build
npm run build
php artisan config:cache
php artisan route:cache
```

## 📁 Key Files Location

| File | Location | Purpose |
|------|----------|---------|
| Main Layout | `resources/views/layouts/app.blade.php` | Sidebar, topbar, modal |
| Kanban Board | `resources/views/tasks/index.blade.php` | Main kanban view |
| Task Card | `resources/views/tasks/card.blade.php` | Card component |
| Controller | `app/Http/Controllers/TaskController.php` | Business logic |
| Model | `app/Models/Task.php` | Database model |
| Migration | `database/migrations/` | Table schema |
| Routes | `routes/web.php` | URL routes |
| Styles | `resources/css/app.css` | Custom CSS |

## 🎨 Tailwind Classes Quick Ref

```blade
<!-- Colors -->
<div class="text-indigo-500">Text</div>
<div class="bg-purple-100">Background</div>
<div class="border-red-500">Border</div>

<!-- Spacing -->
<div class="p-6">Padding</div>
<div class="m-4">Margin</div>
<div class="gap-3">Gap (flex)</div>

<!-- Layout -->
<div class="flex items-center justify-between">Flex</div>
<div class="grid grid-cols-4">Grid</div>

<!-- Text -->
<p class="font-bold">Bold</p>
<p class="text-sm">Small</p>
<p class="line-clamp-2">Truncate 2 lines</p>

<!-- Hover -->
<button class="hover:bg-indigo-600">Hover state</button>

<!-- Responsive -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
```

## 🔑 Alpine.js Directives

```blade
<!-- Event handlers -->
@click="variable = !variable"
@submit.prevent="handleSubmit"
@click.outside="close()"

<!-- Conditional rendering -->
<div x-show="isOpen">Show/hide</div>
<div x-if="isOpen">Render/remove</div>
<div x-cloak>Hide until Alpine loads</div>

<!-- Data binding -->
<input x-model="formData">

<!-- Dispatch event -->
$dispatch('custom-event')
@custom-event.window="handler"

<!-- Initialization -->
<div x-data="{ isOpen: false }">
```

## 📊 Database Enums

### Status
- `todo` - Belum Mulai
- `progress` - Sedang Dikerjakan
- `review` - Review
- `done` - Selesai

### Category
- `design` - Desain (Purple)
- `dev` - Pengembangan (Blue)
- `bug` - Bug (Red)
- `research` - Riset (Green)

### Priority
- `low` - Rendah (Green)
- `medium` - Sedang (Yellow)
- `high` - Tinggi (Red)

## 🛣️ API Endpoints

```
GET    /tasks               → List all (kanban view)
POST   /tasks               → Create
PUT    /tasks/{id}          → Update
DELETE /tasks/{id}          → Delete
```

## 📝 Form Validation Rules

```php
'title' => 'required|string|max:255',
'description' => 'nullable|string|max:1000',
'category' => 'required|in:design,dev,bug,research',
'priority' => 'required|in:low,medium,high',
'status' => 'in:todo,progress,review,done',
'due_date' => 'nullable|date',
'assignee' => 'nullable|string|max:255',
'progress' => 'integer|min:0|max:100',
```

## 🎯 Model Accessors

```php
$task->category_color    // Returns color class
$task->priority_color    // Returns color class
$task->status_label      // Returns label (id)
$task->category_label    // Returns label (id)
$task->priority_label    // Returns label (id)
```

## 🔧 Common Tasks

### Add a new field
1. Create migration: `php artisan make:migration add_field_to_tasks`
2. Add to `$fillable` in Model
3. Add validation in Controller
4. Update view

### Change a color
Search Tailwind class in blade file and update:
```blade
bg-indigo-500  → bg-purple-500
```

### Add new status
1. Update migration enum
2. Add label in Model accessor
3. Add column in kanban board view

### Run specific seeder
```bash
php artisan db:seed --class=TaskSeeder
```

### Check validation errors
```blade
@error('field_name')
    <span class="error">{{ $message }}</span>
@enderror
```

## 🧪 Testing Commands

```bash
# Create test
php artisan make:test TaskTest

# Run tests
php artisan test

# Run specific test
php artisan test tests/Feature/TaskTest.php

# Test with coverage
php artisan test --coverage
```

## 🐛 Debugging Tips

```php
// Dump and die
dd($variable);

// Dump without stopping
dump($variable);

// Log message
\Log::info('Message', ['data' => $variable]);

// Tinker shell
php artisan tinker
```

## 📦 Installed Packages

### NPM
- `alpine.js` - Lightweight interactivity
- `tailwindcss` - Utility-first CSS
- `vite` - Build tool
- `laravel-vite-plugin` - Laravel + Vite integration
- `autoprefixer` - CSS vendor prefixes
- `postcss` - CSS preprocessing

### Composer
- `laravel/framework` - Main framework
- `laravel/tinker` - REPL
- Development: `laravel/sail`, `phpunit/phpunit`, `fakerphp/faker`

## 🎓 Learning Resources

- [Laravel Docs](https://laravel.com/docs)
- [Blade Templating](https://laravel.com/docs/blade)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Eloquent ORM](https://laravel.com/docs/eloquent)

## ✅ Deployment Checklist

- [ ] `APP_DEBUG` = false
- [ ] `APP_ENV` = production
- [ ] Run migrations
- [ ] Run seeders (if needed)
- [ ] Build assets: `npm run build`
- [ ] Cache config: `php artisan config:cache`
- [ ] Cache routes: `php artisan route:cache`
- [ ] Optimize: `php artisan optimize`
- [ ] Setup SSL
- [ ] Setup backups

## 🔐 Security Headers

Already handled:
- ✅ CSRF protection (Laravel default)
- ✅ XSS protection (Blade escaping)
- ✅ SQL injection protection (Eloquent)
- ✅ Password hashing (if auth added)

## 📊 Statistics Calculation

```php
$stats = [
    'total' => $tasks->count(),
    'inProgress' => $tasks->where('status', 'progress')->count(),
    'completed' => $tasks->where('status', 'done')->count(),
    'highPriority' => $tasks->where('priority', 'high')->count(),
];
```

## 🎨 Color Reference

```css
/* Primary Colors */
Indigo: #6366f1
Purple: #9333ea
Blue: #3b82f6

/* Status Colors */
Green (done): #22c55e
Yellow (medium): #eab308
Red (high): #ef4444
Gray (low): #6b7280

/* Background */
White: #ffffff
Slate-50: #f8fafc
Slate-100: #f1f5f9
```

## 💡 Pro Tips

1. Use `@forelse` to handle empty states elegantly
2. Use `@include` to reuse components
3. Use Model accessors for computed properties
4. Use validation rules consistently
5. Use Eloquent methods over raw SQL
6. Use Blade helpers like `@auth`, `@guest`
7. Always test before deploying
8. Use Git branches for features

## 🔄 Update Status Workflow

```
Belum Mulai (todo)
        ↓
Sedang Dikerjakan (progress)
        ↓
Review (review)
        ↓
Selesai (done)
```

Form untuk update status ada di task card dropdown menu.

---

**Last Updated**: 2024
**Version**: 1.0.0
