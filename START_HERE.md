# 🚀 Task Manager - Start Here

Selamat datang di Task Manager! Aplikasi Kanban Board modern berbasis Laravel 12.

---

## 📋 Apa itu Task Manager?

Task Manager adalah aplikasi manajemen tugas dengan interface Kanban Board yang intuitif. Anda dapat:
- ✅ Membuat tugas baru
- ✅ Mengorganisir tugas dalam 4 status (Belum Mulai, Sedang Dikerjakan, Review, Selesai)
- ✅ Melacak progress setiap tugas (0-100%)
- ✅ Mengkategorisasi tugas (Design, Dev, Bug, Research)
- ✅ Menetapkan prioritas (Tinggi, Sedang, Rendah)
- ✅ Melihat statistik dashboard

---

## 🎯 Quick Start (5 Menit)

### 1️⃣ Install Dependencies
```bash
composer install
npm install
```

### 2️⃣ Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3️⃣ Configure Database
Edit `.env`:
```env
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Run Database
```bash
php artisan migrate
php artisan db:seed --class=TaskSeeder
```

### 5️⃣ Start Application
```bash
npm run dev    # Terminal 1
php artisan serve   # Terminal 2
```

✅ Buka `http://localhost:8000`

---

## 📂 File Penting

Sebelum mulai coding, kenali file-file utama:

### Backend
| File | Fungsi |
|------|--------|
| `app/Models/Task.php` | Struktur data tugas |
| `app/Http/Controllers/TaskController.php` | Logic aplikasi |
| `routes/web.php` | URL routes |
| `database/migrations/` | Database schema |

### Frontend
| File | Fungsi |
|------|--------|
| `resources/views/layouts/app.blade.php` | Layout utama |
| `resources/views/tasks/index.blade.php` | Kanban board |
| `resources/views/tasks/card.blade.php` | Card component |
| `resources/css/app.css` | Custom styling |

---

## 🎨 Layout Overview

```
┌─ SIDEBAR ─┬──────────────────────────────────────┐
│           │  TOPBAR (Search + Add Button)        │
│ Kanban    ├──────────────────────────────────────┤
│ Kalender  │ ┌─ Statistics (4 cards) ─────────┐  │
│ Laporan   │ └─────────────────────────────────┘  │
│ Tim       │                                      │
│ Notifikasi│ ┌─ Kanban Board (4 columns) ──┐    │
│ Pengaturan│ │  Column 1 | 2 | 3 | 4       │    │
│           │ │  ┌─────┐  ┌─────┐ ...       │    │
│           │ │  │Card │  │Card │           │    │
│           │ │  └─────┘  └─────┘           │    │
│           │ └─────────────────────────────┘    │
└───────────┴──────────────────────────────────────┘
```

---

## 📱 Fitur-Fitur

### 1. Kanban Board
4 kolom yang mewakili status:
- **Belum Mulai** (gray) - Task baru
- **Sedang Dikerjakan** (blue) - Task sedang dikerjakan
- **Review** (yellow) - Task menunggu review
- **Selesai** (green) - Task selesai

### 2. Task Card
Setiap card menampilkan:
```
┌─────────────────────────────┐
│ 📋 Judul Task               │
│ [Tag Kategori]              │
│ Deskripsi preview...        │
│ [Badge Prioritas]           │
│ Progress: ████░░░░ 50%     │
│ 📅 25 Mar    👤 Avatar     │
└─────────────────────────────┘
```

### 3. Statistics Dashboard
4 kartu statistik:
- Total Tugas
- Sedang Berjalan
- Selesai
- Prioritas Tinggi

### 4. Modal Tambah Tugas
Form untuk membuat task baru dengan:
- Judul (required)
- Deskripsi
- Kategori
- Prioritas
- Tanggal tenggat
- Assignee

---

## 🔧 Teknologi Stack

```
Frontend:
├── Blade Template Engine
├── Tailwind CSS (Styling)
└── Alpine.js (Interaktivitas)

Backend:
├── Laravel 12
├── PHP 8.2+
├── Eloquent ORM
└── SQLite/MySQL/PostgreSQL

Build Tool:
├── Vite
├── PostCSS
└── NPM
```

---

## 📚 Documentation

Sesuai kebutuhan Anda, baca dokumentasi ini:

### Pemula?
→ Baca **SETUP_INSTRUCTIONS.md** untuk instalasi lengkap

### Ingin Development?
→ Baca **DEVELOPMENT_GUIDE.md** untuk cara menambah fitur

### Perlu Reference Cepat?
→ Baca **QUICK_REFERENCE.md** untuk command & contoh

### Perlu API Info?
→ Baca **API_DOCUMENTATION.md** untuk endpoint details

### Lihat Semua File?
→ Baca **FILE_MANIFEST.md** untuk struktur lengkap

---

## 🚀 Tahap-Tahap Development

### Stage 1: Setup ✅
- Install dependencies
- Configure database
- Seed data

### Stage 2: Explore 🔍
- Buka aplikasi di browser
- Klik "Tambah Tugas"
- Lihat data di Kanban board

### Stage 3: Modify 📝
- Edit `resources/views/tasks/card.blade.php` untuk ubah card
- Edit `resources/css/app.css` untuk ubah styling
- Edit `app/Http/Controllers/TaskController.php` untuk ubah logic

### Stage 4: Test 🧪
- Buat beberapa task
- Move antar status
- Hapus task
- Lihat statistik update

### Stage 5: Deploy 🚀
- Build: `npm run build`
- Push ke server
- Run migrations
- Enjoy!

---

## 💡 Tips & Tricks

### 1. Modifikasi Warna
Cari class Tailwind di file blade dan ubah:
```blade
<!-- Ubah warna priority badge -->
bg-red-100 → bg-pink-100
```

### 2. Tambah Status Baru
1. Update migration: `add_status_value_to_tasks`
2. Update Model accessor
3. Tambah kolom di kanban board

### 3. Update Validasi
Edit di `TaskController@store()`:
```php
'title' => 'required|string|max:255',
```

### 4. Debug Mode
Gunakan `dd()` untuk debugging:
```blade
{{ dd($tasks) }}
```

---

## 🎓 Learn While Coding

### Laravel Concepts
- Models → File: `app/Models/Task.php`
- Controllers → File: `app/Http/Controllers/TaskController.php`
- Views → Files: `resources/views/tasks/`
- Migrations → File: `database/migrations/`
- Routing → File: `routes/web.php`

### Blade Templating
- `@foreach` - Loop
- `@if` / `@else` - Conditionals
- `{{ }}` - Echo
- `@csrf` - CSRF token

### Tailwind CSS
- `bg-indigo-500` - Background color
- `p-6` - Padding
- `flex items-center` - Flexbox
- `grid grid-cols-4` - Grid layout

### Alpine.js
- `@click="action"` - Click event
- `x-data="{ open: false }"` - State
- `x-show="open"` - Show/hide
- `$dispatch()` - Event dispatch

---

## 🐛 Troubleshooting

### Issue: "SQLSTATE[HY000]: General error"
**Solution**: Run migration
```bash
php artisan migrate
```

### Issue: Assets tidak update
**Solution**: Rebuild
```bash
npm run build
```

### Issue: Modal tidak terbuka
**Solution**: Cek Alpine.js di layout
```blade
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### Issue: Database error
**Solution**: Check `.env` configuration
```env
DB_HOST=127.0.0.1
DB_DATABASE=task_manager
```

---

## ✅ Checklist

Sebelum mulai, pastikan:

- [ ] PHP 8.2+ terinstall (`php --version`)
- [ ] Composer terinstall (`composer --version`)
- [ ] Node.js terinstall (`node --version`)
- [ ] Database sudah dibuat/configured
- [ ] `.env` file sudah dikonfigurasi
- [ ] Migration sudah dijalankan
- [ ] Seeder sudah dijalankan (optional)
- [ ] Assets sudah dibuilt (`npm run build`)
- [ ] Server berjalan (`php artisan serve`)

---

## 🎯 Next Steps

1. **Jalan-jalan di aplikasi**
   - Buat beberapa task
   - Ubah status
   - Lihat statistik

2. **Understand the code**
   - Baca `TaskController.php`
   - Baca `Task.php` model
   - Baca blade templates

3. **Modifikasi sesuatu**
   - Ubah warna
   - Tambah field baru
   - Modifikasi validasi

4. **Deploy**
   - Build assets
   - Upload ke server
   - Run migrations
   - Set production `.env`

---

## 📞 Help & Resources

### Dokumentasi
- 📖 [Laravel Docs](https://laravel.com/docs)
- 🎨 [Tailwind CSS](https://tailwindcss.com)
- 🏔️ [Alpine.js](https://alpinejs.dev)

### Files
- 📄 README.md - Project overview
- 📄 SETUP_INSTRUCTIONS.md - Installation
- 📄 DEVELOPMENT_GUIDE.md - Development
- 📄 QUICK_REFERENCE.md - Quick tips
- 📄 API_DOCUMENTATION.md - API reference

### Common Tasks
```bash
# Create migration
php artisan make:migration migration_name

# Create model
php artisan make:model ModelName

# Create controller
php artisan make:controller ControllerName

# Run tests
php artisan test

# Access shell
php artisan tinker
```

---

## 🎉 Selamat!

Anda siap memulai! Pilih salah satu:

- **Ingin jalan-jalan?** → Buka browser, kunjungi `http://localhost:8000`
- **Ingin belajar?** → Baca **DEVELOPMENT_GUIDE.md**
- **Ingin ngedit?** → Edit files di `resources/views/`
- **Ingin deploy?** → Baca section "Deploy" di docs

---

**Happy Coding! 🚀**

---

**Questions?** Check the documentation files or read the code comments.

**Version**: 1.0.0  
**Created**: June 3, 2026
