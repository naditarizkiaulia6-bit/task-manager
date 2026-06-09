# Task Manager - Setup Instructions

## Persyaratan Sistem
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & npm
- Database (MySQL, PostgreSQL, SQLite)

## Instalasi Step by Step

### 1. Clone Repository
```bash
git clone <repository-url>
cd task-manager
```

### 2. Install Dependencies PHP
```bash
composer install
```

### 3. Install Dependencies JavaScript
```bash
npm install
```

### 4. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan atur database connection Anda:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Setup Database
```bash
# Jalankan migration
php artisan migrate

# (Optional) Jalankan seeder untuk data dummy
php artisan db:seed --class=TaskSeeder
```

### 6. Build Assets
```bash
npm run build
```

Untuk development dengan live reload:
```bash
npm run dev
```

### 7. Jalankan Server
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## Struktur File

```
├── app/
│   ├── Http/Controllers/
│   │   └── TaskController.php       # Controller untuk Task
│   └── Models/
│       └── Task.php                 # Model Task
├── database/
│   ├── migrations/
│   │   └── create_tasks_table.php   # Migration tabel tasks
│   └── seeders/
│       └── TaskSeeder.php           # Seeder data dummy
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php        # Layout utama
│   │   └── tasks/
│   │       ├── index.blade.php      # Halaman kanban
│   │       └── card.blade.php       # Komponen kartu tugas
│   └── css/
│       └── app.css                  # Tailwind CSS
├── routes/
│   └── web.php                      # Web routes
└── tailwind.config.js               # Tailwind configuration
```

## Fitur Utama

### 1. Kanban Board
- 4 kolom status: Belum Mulai, Sedang Dikerjakan, Review, Selesai
- Drag & drop (dapat dikembangkan)
- Real-time counter untuk setiap kolom

### 2. Kartu Tugas
Menampilkan:
- Judul tugas
- Deskripsi (preview)
- Tag kategori (Design, Dev, Bug, Research)
- Badge prioritas (Tinggi, Sedang, Rendah)
- Progress bar (0-100%)
- Tanggal tenggat
- Avatar assignee

### 3. Modal Tambah Tugas
Form lengkap dengan:
- Validasi Laravel (server-side)
- Field yang user-friendly
- Auto-redirect setelah submit

### 4. Statistik Dashboard
Menampilkan:
- Total tugas
- Tugas sedang berjalan
- Tugas selesai
- Tugas prioritas tinggi

### 5. Sidebar Navigation
- Kanban (aktif)
- Kalender (stub)
- Laporan (stub)
- Tim (stub)
- Notifikasi (stub)
- Pengaturan (stub)

## Warna & Desain

### Kategori Tags
- Design: Purple (#9333ea)
- Dev: Blue (#3b82f6)
- Bug: Red (#ef4444)
- Research: Green (#22c55e)

### Priority Badges
- High: Red (#ef4444)
- Medium: Yellow (#eab308)
- Low: Green (#22c55e)

### Status Colors
- Belum Mulai: Gray
- Sedang Dikerjakan: Blue
- Review: Yellow
- Selesai: Green

## API Endpoints

| Method | Route | Controller | Deskripsi |
|--------|-------|-----------|-----------|
| GET | /tasks | TaskController@index | Tampilkan semua tugas |
| POST | /tasks | TaskController@store | Simpan tugas baru |
| PUT | /tasks/{id} | TaskController@update | Update tugas |
| DELETE | /tasks/{id} | TaskController@destroy | Hapus tugas |

## Database Schema

### Tabel: tasks
```sql
- id (Primary Key)
- title (string)
- description (text, nullable)
- category (enum: design, dev, bug, research)
- priority (enum: low, medium, high)
- status (enum: todo, progress, review, done)
- due_date (date, nullable)
- assignee (string, nullable)
- progress (integer: 0-100)
- created_at (timestamp)
- updated_at (timestamp)
```

## Development Tips

### Menambah Fitur Baru
1. Buat migration jika ada perubahan database
2. Update Model dengan fillable properties
3. Update Controller dengan logic baru
4. Buat atau update Blade template
5. Test di browser

### Customization
- Warna: Edit Tailwind classes di Blade files
- Font: Configure di `tailwind.config.js`
- Icons: Gunakan inline SVG atau tambahkan library (Hero Icons / Font Awesome)

### Testing
```bash
php artisan tinker
```

## Troubleshooting

### Issue: Migration tidak berjalan
```bash
php artisan migrate:fresh
php artisan migrate --seed
```

### Issue: Assets tidak ter-compile
```bash
npm run build
# atau untuk development
npm run dev
```

### Issue: Database error
- Pastikan database sudah dibuat
- Cek konfigurasi `.env`
- Jalankan `php artisan migrate:refresh`

## Next Steps untuk Deployment

1. Setup environment production di `.env`
2. Generate app key: `php artisan key:generate`
3. Run migrations: `php artisan migrate --force`
4. Seed data: `php artisan db:seed --force`
5. Build assets: `npm run build`
6. Setup webserver (Nginx/Apache)
7. Configure domain & SSL

## License
MIT
