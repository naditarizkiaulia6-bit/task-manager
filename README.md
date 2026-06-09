# 📊 Task Manager - Laravel Kanban Board

Aplikasi Task Manager berbasis Laravel 12 dengan interface Kanban Board interaktif yang dibangun menggunakan Blade templating, Tailwind CSS, dan Alpine.js.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-3.4-06B6D4?style=flat-square&logo=tailwind-css)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.13-77C4D3?style=flat-square&logo=alpine.js)

## ✨ Fitur Utama

### 🎯 Kanban Board
- **4 Kolom Status**: Belum Mulai, Sedang Dikerjakan, Review, Selesai
- **Real-time Counter**: Jumlah tugas di setiap kolom
- **Responsive Design**: Mobile-friendly interface
- **Visual Organization**: Kartu tugas yang rapi dan mudah dibaca

### 📝 Task Management
- **Membuat Tugas Baru**: Form modal dengan validasi
- **Edit Status**: Lanjutkan tugas ke status berikutnya
- **Hapus Tugas**: Soft delete dengan konfirmasi
- **Track Progress**: Progress bar 0-100%

### 🏷️ Kategorisasi
- **4 Kategori**: Design, Development, Bug, Research
- **Warna Unik**: Setiap kategori memiliki warna yang berbeda
- **Tag Visual**: Mudah identifikasi jenis tugas

### ⚡ Prioritas
- **3 Level Prioritas**: Tinggi, Sedang, Rendah
- **Visual Indicators**: Badge berwarna untuk setiap level
- **Filter Otomatis**: Statistik tugas prioritas tinggi

### 📊 Dashboard Statistics
- **Total Tugas**: Jumlah semua tugas
- **Sedang Berjalan**: Tugas dalam progress
- **Selesai**: Tugas yang sudah diselesaikan
- **Prioritas Tinggi**: Tugas dengan prioritas tinggi

### 👥 Assignee Management
- **Assign Tugas**: Berikan tugas ke tim member
- **Avatar Display**: Initial huruf nama assignee
- **Quick Reference**: Identifikasi pemilik tugas dengan cepat

### 📅 Due Date Tracking
- **Tanggal Tenggat**: Track deadline setiap tugas
- **Visual Format**: Tampilan date yang user-friendly
- **Reminder Ready**: Siap untuk fitur reminder

## 🗂️ Struktur Direktori

```
task-manager/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── TaskController.php       # Main controller
│   └── Models/
│       └── Task.php                     # Task model
├── database/
│   ├── migrations/
│   │   └── 2024_01_01_000000_create_tasks_table.php
│   └── seeders/
│       └── TaskSeeder.php               # 10 sample data
├── resources/
│   ├── css/
│   │   └── app.css                      # Tailwind CSS
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php            # Main layout
│       └── tasks/
│           ├── index.blade.php          # Kanban board
│           └── card.blade.php           # Task card component
├── routes/
│   └── web.php                          # Web routes
├── vite.config.js                       # Vite config
├── tailwind.config.js                   # Tailwind config
├── postcss.config.js                    # PostCSS config
└── package.json                         # NPM dependencies
```

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js 16+ & npm
- Database (MySQL/PostgreSQL/SQLite)

### Installation

1. **Clone Repository**
```bash
git clone <repository-url>
cd task-manager
```

2. **Install PHP Dependencies**
```bash
composer install
```

3. **Install Node Dependencies**
```bash
npm install
```

4. **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure Database** (edit `.env`)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run Migrations**
```bash
php artisan migrate
```

7. **Seed Sample Data** (optional)
```bash
php artisan db:seed --class=TaskSeeder
```

8. **Build Assets**
```bash
npm run build
# or for development with hot reload:
npm run dev
```

9. **Start Server**
```bash
php artisan serve
```

Access: `http://localhost:8000`

## 📱 UI Components

### Task Card
```
┌─ Judul Tugas ──────────────────────┐
│                                     │
│ [Tag Kategori]                      │
│ Deskripsi preview text...           │
│ [Badge Prioritas]                   │
│                                     │
│ Progress: 50%  ████░░░░░░░░░░░░   │
│                                     │
│ 📅 25 Mar       👤 Avatar          │
└─────────────────────────────────────┘
```

### Kanban Columns
```
┌─ Belum Mulai (3) ─┐ ┌─ Sedang Dikerjakan (2) ─┐
│  ┌─────────────┐  │ │  ┌─────────────┐         │
│  │ Card 1      │  │ │  │ Card 1      │         │
│  └─────────────┘  │ │  └─────────────┘         │
│  ┌─────────────┐  │ │  ┌─────────────┐         │
│  │ Card 2      │  │ │  │ Card 2      │         │
│  └─────────────┘  │ │  └─────────────┘         │
└────────────────────┘ └────────────────────────┘
```

## 🎨 Color Scheme

### Categories
- **Design**: Purple (#9333ea)
- **Dev**: Blue (#3b82f6)
- **Bug**: Red (#ef4444)
- **Research**: Green (#22c55e)

### Priority
- **High**: Red (#ef4444)
- **Medium**: Yellow (#eab308)
- **Low**: Green (#22c55e)

### Status
- **Todo**: Gray (#6b7280)
- **Progress**: Blue (#3b82f6)
- **Review**: Yellow (#eab308)
- **Done**: Green (#22c55e)

## 📡 API Routes

| Method | Route | Handler | Description |
|--------|-------|---------|-------------|
| GET | `/tasks` | `TaskController@index` | Display all tasks (kanban view) |
| POST | `/tasks` | `TaskController@store` | Create new task |
| PUT | `/tasks/{task}` | `TaskController@update` | Update task status/data |
| DELETE | `/tasks/{task}` | `TaskController@destroy` | Delete task |

## 🗄️ Database Schema

### tasks table
```sql
CREATE TABLE tasks (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description LONGTEXT,
  category ENUM('design', 'dev', 'bug', 'research') DEFAULT 'dev',
  priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
  status ENUM('todo', 'progress', 'review', 'done') DEFAULT 'todo',
  due_date DATE,
  assignee VARCHAR(255),
  progress INT DEFAULT 0 CHECK (progress BETWEEN 0 AND 100),
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

## 🔧 Usage Examples

### Create Task
```bash
curl -X POST http://localhost:8000/tasks \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Design Homepage",
    "description": "Create homepage design",
    "category": "design",
    "priority": "high",
    "due_date": "2024-12-31",
    "assignee": "John Doe"
  }'
```

### Update Task Status
```bash
curl -X PUT http://localhost:8000/tasks/1 \
  -H "Content-Type: application/json" \
  -d '{
    "status": "progress",
    "progress": 50
  }'
```

## 🎯 Alpine.js Features

### Modal Trigger
```blade
<button @click="$dispatch('open-task-modal')">
  Add Task
</button>
```

### Dropdown Menu
```blade
<div x-data="{ showMenu: false }">
  <button @click="showMenu = !showMenu">Menu</button>
  <div x-show="showMenu" @click.outside="showMenu = false">
    <!-- Menu items -->
  </div>
</div>
```

## 📋 Sample Data (TaskSeeder)

Seeder menyediakan 10 contoh tugas:
- 2 tugas di status "Belum Mulai"
- 3 tugas di status "Sedang Dikerjakan"
- 2 tugas di status "Review"
- 3 tugas di status "Selesai"

Dengan berbagai kategori, prioritas, dan assignee yang berbeda.

## 🔐 Security Features

- ✅ CSRF Token Protection
- ✅ Input Validation (Laravel validation rules)
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ XSS Protection (Blade escaping)
- ✅ Confirmation Dialogs (Delete action)

## 🚀 Performance Optimization

- Minimal JavaScript (Alpine.js only ~5KB)
- CSS preprocessing with Tailwind
- Single Laravel request per page load
- Optimized database queries with Eloquent
- Vite for fast development & production build

## 📈 Future Enhancements

- [ ] Drag & drop functionality between columns
- [ ] User authentication & authorization
- [ ] Comment system on tasks
- [ ] File attachments
- [ ] Calendar view
- [ ] Reports & analytics
- [ ] Team collaboration features
- [ ] Notifications system
- [ ] Task time tracking
- [ ] API authentication (Sanctum)

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the MIT license.

## 📞 Support

For support, email support@taskmanager.local or open an issue in the repository.

## 👨‍💻 Author

Created with ❤️ for efficient task management

---

**Made with Laravel 12 • Tailwind CSS • Alpine.js**
