# Task Manager - File Manifest

## Project Overview
Task Manager adalah aplikasi Kanban Board berbasis Laravel 12 dengan teknologi modern (Blade, Tailwind CSS, Alpine.js).

---

## 📋 File Structure

### 📂 Backend (Laravel)

#### Controllers
- **`app/Http/Controllers/TaskController.php`**
  - `index()` - Tampilkan semua task, group by status
  - `store()` - Validasi & simpan task baru
  - `update()` - Update status/data task
  - `destroy()` - Hapus task

#### Models
- **`app/Models/Task.php`**
  - Eloquent model untuk tasks table
  - Accessor methods untuk warna kategori & prioritas
  - Label methods untuk tampilan

#### Database
- **`database/migrations/2024_01_01_000000_create_tasks_table.php`**
  - Schema: id, title, description, category, priority, status, due_date, assignee, progress, timestamps
  - Enum constraints untuk category, priority, status
  
- **`database/seeders/TaskSeeder.php`**
  - 10 contoh data task
  - Distributed across all statuses
  - Various categories, priorities, assignees

#### Routing
- **`routes/web.php`**
  - Ressource routes untuk tasks (index, store, update, destroy)
  - Redirect root ke tasks.index

### 🎨 Frontend (Views)

#### Layouts
- **`resources/views/layouts/app.blade.php`** (Main Layout)
  - Sidebar navigation (7 menu items)
  - Topbar dengan search & add button
  - Modal untuk tambah task (Alpine.js)
  - Statistics cards
  - Success message flash

#### Views
- **`resources/views/tasks/index.blade.php`** (Kanban Board)
  - 4 column layout: todo, progress, review, done
  - Statistics cards (4 cards)
  - Task counter per kolom
  - Empty state handling
  
- **`resources/views/tasks/card.blade.php`** (Task Card Component)
  - Title, description preview
  - Category tag (warna unik)
  - Priority badge (warna unik)
  - Progress bar (0-100%)
  - Due date & assignee avatar
  - Dropdown menu (Update status, Edit, Delete)

### 🎨 Styling

- **`resources/css/app.css`**
  - Tailwind directives (@tailwind base/components/utilities)
  - Custom component utilities (.btn, .card, .badge)
  - Line clamp utilities
  - Scrollbar styling
  
- **`tailwind.config.js`**
  - Content paths untuk Blade files & JS
  - Theme customizations
  - Plugin: @tailwindcss/line-clamp

- **`postcss.config.js`**
  - Tailwind & autoprefixer configuration

### ⚙️ Build & Configuration

- **`vite.config.js`**
  - Vite + Laravel plugin configuration
  - Entry points: CSS & JS
  - Hot reload enabled

- **`package.json`**
  - Dev dependencies: vite, tailwindcss, alpinejs, laravel-vite-plugin
  - Scripts: dev, build, preview
  - Dependencies: @heroicons/react

- **`config/app.php`**
  - Laravel configuration
  - Service providers
  - Aliases

- **`.env.example`**
  - Template untuk konfigurasi environment
  - Database connection settings
  - Mail & queue configuration

### 📚 JavaScript

- **`resources/js/app.js`**
  - Main entry point
  - Alpine.js initialization (optional dari CDN)
  
- **`resources/js/bootstrap.js`**
  - Axios configuration
  - HTTP headers setup

### 📖 Documentation

- **`README.md`**
  - Project overview
  - Features description
  - Quick start guide
  - Technology stack
  - API endpoints
  - Future enhancements

- **`SETUP_INSTRUCTIONS.md`**
  - Step-by-step installation
  - Environment setup
  - Database configuration
  - Development server
  - Troubleshooting

- **`DEVELOPMENT_GUIDE.md`**
  - Architecture overview
  - Development workflow
  - Common tasks
  - Testing guide
  - Performance tips
  - Debugging techniques
  - Deployment checklist

- **`QUICK_REFERENCE.md`**
  - Command reference
  - File locations
  - Tailwind classes reference
  - Alpine directives
  - Database enums
  - Validation rules
  - Common tasks shortcuts

- **`FILE_MANIFEST.md`** (This file)
  - Complete file listing
  - File descriptions

---

## 🎯 File Summary Table

| File | Type | Purpose | Lines |
|------|------|---------|-------|
| `TaskController.php` | PHP | Main controller | ~80 |
| `Task.php` | PHP | Eloquent model | ~80 |
| `create_tasks_table.php` | PHP | Migration | ~35 |
| `TaskSeeder.php` | PHP | Seed data | ~95 |
| `app.blade.php` | Blade | Main layout | ~180 |
| `index.blade.php` | Blade | Kanban view | ~150 |
| `card.blade.php` | Blade | Card component | ~90 |
| `app.css` | CSS | Styling | ~60 |
| `tailwind.config.js` | JS | Tailwind config | ~15 |
| `vite.config.js` | JS | Vite config | ~10 |
| `package.json` | JSON | NPM packages | ~30 |
| Documentation files | Markdown | Guides & reference | ~1500 total |

---

## 🔄 Data Flow

```
User Action (Click "Tambah Tugas")
        ↓
Alpine.js: $dispatch('open-task-modal')
        ↓
Modal Form (Blade)
        ↓
Form Submit
        ↓
POST /tasks (Laravel routing)
        ↓
TaskController@store()
        ↓
Validate (Laravel validation)
        ↓
Task::create() (Eloquent model)
        ↓
Database Insert
        ↓
Redirect with success message
        ↓
GET /tasks
        ↓
TaskController@index()
        ↓
Group by status, fetch stats
        ↓
Blade rendering
        ↓
Display Kanban Board
```

---

## 📦 Dependencies

### PHP/Laravel
```
laravel/framework: ^12.0
PHP: ^8.2
```

### NPM Packages
```
vite: ^5.0
tailwindcss: ^3.4
alpine.js: ^3.13
laravel-vite-plugin: ^1.3
postcss: ^8.4
autoprefixer: ^10.4
axios: ^1.6
@tailwindcss/line-clamp: ^0.4
@heroicons/react: ^2.0
```

---

## 🎨 Design System

### Colors
- **Primary**: Indigo (#6366f1)
- **Categories**: Purple, Blue, Red, Green
- **Priorities**: Red (high), Yellow (medium), Green (low)
- **Status**: Different colors per status

### Typography
- **Font**: Inter, system-ui, sans-serif
- **Sizes**: Base (16px), SM (14px), LG (18px), XL (20px)

### Components
- **Sidebar**: Gray-50 background, icon + text navigation
- **Cards**: White with shadow, rounded-xl
- **Buttons**: Indigo primary, slate secondary
- **Modal**: Centered, white background, close button
- **Progress**: Blue bar with percentage

---

## 🚀 Getting Started

1. **Clone** repository
2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```
3. **Configure** `.env` file
4. **Migrate** database:
   ```bash
   php artisan migrate
   ```
5. **Seed** data:
   ```bash
   php artisan db:seed --class=TaskSeeder
   ```
6. **Build** assets:
   ```bash
   npm run build
   ```
7. **Start** server:
   ```bash
   php artisan serve
   npm run dev
   ```
8. **Access** at `http://localhost:8000`

---

## 📊 Database Schema

### tasks Table
```sql
id          BIGINT PRIMARY KEY
title       VARCHAR(255) NOT NULL
description LONGTEXT
category    ENUM (design, dev, bug, research)
priority    ENUM (low, medium, high)
status      ENUM (todo, progress, review, done)
due_date    DATE
assignee    VARCHAR(255)
progress    INT (0-100)
created_at  TIMESTAMP
updated_at  TIMESTAMP
```

---

## 🔐 Security Features

✅ CSRF Token Protection (Laravel default)
✅ Input Validation (server-side)
✅ XSS Protection (Blade escaping)
✅ SQL Injection Prevention (Eloquent ORM)
✅ Delete Confirmation Dialog

---

## ✨ Features Checklist

- ✅ Kanban Board (4 columns)
- ✅ Task Management (CRUD)
- ✅ Category Tagging (4 categories)
- ✅ Priority Levels (3 levels)
- ✅ Progress Tracking (0-100%)
- ✅ Due Date Assignment
- ✅ Assignee Management
- ✅ Statistics Dashboard
- ✅ Responsive Design
- ✅ Dark UI Theme
- ✅ Modal Form
- ✅ Input Validation
- ✅ Empty States

---

## 🎓 Next Steps

1. **Authentication**: Add user authentication (Sanctum/Fortify)
2. **Drag & Drop**: Implement drag-and-drop between columns
3. **Comments**: Add comments system to tasks
4. **File Attachments**: Upload files to tasks
5. **Team Management**: Multi-user support
6. **Notifications**: Real-time notifications
7. **Reporting**: Analytics dashboard
8. **Calendar View**: Alternative calendar view
9. **Time Tracking**: Track time spent on tasks
10. **API**: REST API for mobile apps

---

## 📞 Support

For issues or questions:
1. Check documentation files
2. Review QUICK_REFERENCE.md for common solutions
3. Check browser console for JavaScript errors
4. Use `php artisan tinker` for database inspection

---

## 📄 License

MIT License - Free to use and modify

---

**Project Version**: 1.0.0  
**Created**: 2024  
**Last Updated**: June 3, 2026
