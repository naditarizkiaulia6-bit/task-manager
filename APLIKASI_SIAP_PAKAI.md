# ✅ Task Manager - Aplikasi Siap Pakai

Aplikasi **Task Manager** berbasis Laravel 12 dengan fitur Kanban board, manajemen proyek, sistem komentar, dan role-based access control.

## 🚀 Akses Aplikasi

**URL**: http://localhost:8000

Server sudah berjalan otomatis pada port 8000.

---

## 👤 Akun Demo

### Admin Account
- **Email**: admin@example.com
- **Password**: password
- **Role**: Administrator

### User Account
- **Email**: user1@example.com
- **Password**: password
- **Role**: Member

---

## 📋 Fitur Utama

### 1. **Kanban Board** 
- 4 kolom: Belum Mulai, Sedang Dikerjakan, Review, Selesai
- Drag-and-drop support
- Visualisasi status tugas

### 2. **Manajemen Tugas**
- ✏️ Create, Read, Update, Delete (CRUD)
- Kategori: Design, Development, Bug, Research
- Prioritas: High, Medium, Low
- Progress bar (0-100%)
- Tanggal tenggat
- Assignee (penugasan ke user)

### 3. **Manajemen Proyek**
- Buat dan kelola multiple proyek
- Lihat statistik per proyek
- Daftar tugas dalam proyek

### 4. **Sistem Komentar**
- Tambahkan komentar pada tugas
- Lihat history komentar
- Hapus komentar milik sendiri

### 5. **Autentikasi & Otorisasi**
- Registrasi akun baru
- Login dengan email & password
- Proteksi route dengan middleware auth
- Kontrol akses per proyek

### 6. **Dashboard & Statistik**
- Total tugas
- Tugas sedang berjalan
- Tugas selesai
- Tugas prioritas tinggi

---

## 🎨 Desain & UI

- **Tailwind CSS**: Styling modern dari CDN
- **Alpine.js**: Interaktivitas modal dan dropdown
- **Responsive Design**: Desktop, tablet, mobile-friendly
- **Warna Tema**: Indigo/Purple

---

## 📁 Struktur File Penting

```
app/
├── Http/Controllers/
│   ├── TaskController.php       # CRUD Tugas
│   ├── ProjectController.php    # CRUD Proyek
│   └── CommentController.php    # Comment system
├── Models/
│   ├── Task.php                 # Model Tugas
│   ├── Project.php              # Model Proyek
│   ├── Comment.php              # Model Komentar
│   └── User.php                 # Model User
└── Policies/
    └── ProjectPolicy.php        # Authorization

database/
├── migrations/
│   ├── create_users_table
│   ├── create_tasks_table
│   ├── create_projects_table
│   └── create_comments_table
└── seeders/
    ├── UserSeeder.php           # 6 user demo
    ├── ProjectSeeder.php        # 3 proyek demo
    ├── TaskSeeder.php           # 10 tugas demo
    └── CommentSeeder.php        # 10 komentar demo

resources/views/
├── layouts/app.blade.php        # Template utama
├── auth/
│   ├── login.blade.php          # Halaman login
│   └── register.blade.php       # Halaman registrasi
├── tasks/
│   ├── index.blade.php          # Kanban board
│   ├── show.blade.php           # Detail tugas + comments
│   ├── edit.blade.php           # Edit tugas
│   ├── card.blade.php           # Komponen kartu tugas
│   └── empty.blade.php          # State kosong
└── projects/
    ├── index.blade.php          # Daftar proyek
    ├── show.blade.php           # Detail proyek
    └── form.blade.php           # Create/Edit proyek

routes/web.php                   # Semua route aplikasi
```

---

## 🔧 Teknologi Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 12 |
| Frontend | Blade Templating + Tailwind CSS |
| Interactivity | Alpine.js |
| Database | SQLite |
| Authentication | Laravel Built-in Auth |
| Styling | Tailwind CSS (CDN) |

---

## 💾 Database Schema

### Users Table
- id, name, email, password, role (admin/member), timestamps

### Projects Table
- id, user_id (FK), name, description, timestamps

### Tasks Table
- id, project_id (FK), assignee_id (FK), title, description
- category (design/dev/bug/research), priority (high/medium/low)
- status (todo/progress/review/done), due_date, progress (0-100)
- timestamps

### Comments Table
- id, task_id (FK), user_id (FK), body, timestamps

---

## 🎯 Flow Penggunaan

### 1. Login
1. Buka http://localhost:8000
2. Masukkan email & password
3. Klik "Masuk"

### 2. Melihat Kanban Board
1. Setelah login, otomatis ke Dashboard Kanban
2. Lihat tugas tersebar di 4 kolom status
3. Lihat statistik di atas board

### 3. Menambah Tugas
1. Klik tombol "Tambah Tugas" di top-right
2. Isi form (judul, deskripsi, kategori, prioritas, due date)
3. Klik "Simpan Tugas"
4. Tugas akan muncul di kolom "Belum Mulai"

### 4. Mengubah Status Tugas
1. Klik menu (3 dots) di kartu tugas
2. Pilih "Lanjutkan" untuk pindah ke status berikutnya
3. Atau klik kartu untuk lihat detail & edit

### 5. Melihat Detail Tugas
1. Klik pada judul tugas
2. Lihat detail lengkap
3. Lihat & tambah komentar
4. Edit atau hapus tugas

### 6. Mengelola Proyek
1. Klik "Proyek" di sidebar
2. Lihat daftar proyek Anda
3. Buat proyek baru, edit, atau hapus
4. Klik proyek untuk lihat daftar tugas

---

## 🔐 Keamanan

✅ Authentication dengan Laravel Auth  
✅ Password hashing dengan bcrypt  
✅ CSRF protection  
✅ Authorization policies (ProjectPolicy)  
✅ Session management  
✅ Route protection dengan middleware  

---

## ⚡ Perintah Artisan Berguna

```bash
# Refresh database dengan seed
php artisan migrate:fresh --seed

# Clear cache
php artisan config:clear
php artisan cache:clear

# Menjalankan server
php artisan serve --host=127.0.0.1 --port=8000

# Buat migration baru
php artisan make:migration create_table_name

# Buat model baru
php artisan make:model ModelName

# Buat controller baru
php artisan make:controller ControllerName
```

---

## 🐛 Troubleshooting

### Server tidak berjalan?
```bash
cd c:\laragon\www\manajemen-tugas
php artisan serve --host=127.0.0.1 --port=8000
```

### Database error?
```bash
php artisan migrate:fresh --seed
```

### Cache issue?
```bash
php artisan config:clear
php artisan cache:clear
```

---

## 📝 Catatan Penting

1. **Database**: Menggunakan SQLite (database.sqlite)
2. **Asset**: Tailwind CSS & Alpine.js dari CDN (tidak perlu npm build)
3. **Environment**: File .env sudah dikonfigurasi
4. **Demo Data**: 6 user, 3 proyek, 10 tugas, 10 komentar sudah tersedia

---

## ✨ Fitur Ekstension

Fitur yang bisa dikembangkan:
- Notifikasi real-time
- Team collaboration
- File attachment
- Advanced reporting
- Mobile app
- API REST lengkap

---

## 📧 Support

Jika ada pertanyaan atau issue, silakan periksa:
- Error di browser console
- Error di terminal server
- Check database dengan SQLite browser
- Verify route dengan `php artisan route:list`

---

**Status**: ✅ SIAP PAKAI  
**Last Updated**: June 2026  
**Version**: 1.0.0
