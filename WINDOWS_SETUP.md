# 🪟 Windows Setup Guide - Task Manager

Panduan khusus untuk pengguna Windows yang mengalami PowerShell execution policy error.

---

## ⚠️ Problem: PowerShell Execution Policy Error

Jika Anda melihat error seperti ini:
```
npm : File C:\Program Files\nodejs\npm.ps1 cannot be loaded because running 
scripts is disabled on this system.
```

Ini adalah PowerShell security issue, bukan masalah Node.js atau npm.

---

## ✅ Solution #1: Gunakan Batch Script (RECOMMENDED - Paling Mudah)

### Step 1: Double-click file `install.bat`

File ini sudah ada di project folder.

1. Buka File Explorer
2. Navigasi ke: `C:\laragon\www\manajemen-tugas`
3. **Double-click** file: `install.bat`
4. Wait for installation to complete
5. Press Enter when done

**Apa yang akan dilakukan:**
- Install npm packages
- Run database migrations
- Seed sample data
- Build frontend assets

Setelah selesai, lanjut ke **Step 2** di bawah.

---

## ✅ Solution #2: Fix PowerShell Permanently

Jika ingin menggunakan PowerShell untuk future commands:

### Step 1: Run PowerShell Fix Script

1. **Right-click** pada file `fix-powershell.ps1`
2. Select: **"Run with PowerShell"**
3. If prompted, press `Y` for Yes

### Step 2: Confirm Fix

1. **Close** PowerShell window
2. **Open** new PowerShell window
3. Try npm command again:
   ```powershell
   npm install
   ```

Sekarang harus work!

---

## ✅ Solution #3: Use Command Prompt Instead

Cara paling simple - gunakan Command Prompt bukan PowerShell:

### Step 1: Open Command Prompt

1. Press: `Win + R`
2. Type: `cmd`
3. Press: `Enter`

### Step 2: Navigate to Project

```cmd
cd C:\laragon\www\manajemen-tugas
```

### Step 3: Run Commands

```cmd
npm install
php artisan migrate
php artisan db:seed --class=TaskSeeder
npm run build
```

Command Prompt tidak punya PowerShell execution policy, jadi semua command akan work!

---

## 🚀 After Installation

Setelah installation selesai, Anda perlu menjalankan 2 servers:

### Option A: Using Batch Script (Easiest)

**Double-click** file: `run-dev.bat`

Pilih option 3 (Open Both) untuk menjalankan kedua server di window terpisah.

### Option B: Manual (Command Prompt)

**Terminal 1** - Vite Dev Server:
```cmd
npm run dev
```

**Terminal 2** - Laravel Server:
```cmd
php artisan serve
```

### Option C: Manual (PowerShell - setelah fix)

**Terminal 1**:
```powershell
npm run dev
```

**Terminal 2**:
```powershell
php artisan serve
```

---

## 🌐 Open Application

Setelah kedua server running, buka browser:

```
http://localhost:8000
```

Anda seharusnya melihat Kanban board dengan 4 kolom dan 10 sample tasks!

---

## 🛠️ Batch Files yang Tersedia

### 1. `install.bat` - Installation Script
- Menjalankan: npm install
- Menjalankan: php artisan migrate
- Menjalankan: php artisan db:seed
- Menjalankan: npm run build

### 2. `run-dev.bat` - Development Server Launcher
- Pilihan untuk menjalankan Vite server
- Pilihan untuk menjalankan Laravel server
- Pilihan untuk menjalankan keduanya di window terpisah

### 3. `fix-powershell.ps1` - PowerShell Fix Script
- Fix execution policy
- Memungkinkan npm bekerja di PowerShell

---

## 📋 Step-by-Step Quick Guide

### For Quick Setup (Using Batch Scripts):

1. **Double-click** `install.bat` ← Tunggu selesai
2. **Double-click** `run-dev.bat` → Pilih option 3
3. **Open browser** → `http://localhost:8000`

Done! ✅

### For Advanced Users (Manual):

1. Open Command Prompt
2. Run: `npm install`
3. Run: `php artisan migrate`
4. Run: `php artisan db:seed --class=TaskSeeder`
5. Run: `npm run build`
6. Open 2 terminals:
   - Terminal 1: `npm run dev`
   - Terminal 2: `php artisan serve`
7. Open: `http://localhost:8000`

---

## ✨ What You Should See

### In Browser (http://localhost:8000):

✅ Header dengan logo "TaskHub"  
✅ Sidebar dengan 7 menu items  
✅ Topbar dengan search dan "Tambah Tugas" button  
✅ 4 Statistics cards (Total, In Progress, Completed, High Priority)  
✅ Kanban board dengan 4 kolom:
- Belum Mulai (2 tasks)
- Sedang Dikerjakan (3 tasks)
- Review (2 tasks)
- Selesai (3 tasks)

✅ Task cards dengan colors, icons, dan progress bars

### In Terminal:

**Vite Server Output:**
```
  VITE v5.0.0  ready in 234 ms

  ➜  Local:   http://localhost:5173/
  ➜  Press h to show help
```

**Laravel Server Output:**
```
   INFO  Server running on [http://127.0.0.1:8000].

  Press Ctrl+C to quit
```

---

## 🐛 Troubleshooting

### "npm still not found" di Command Prompt

1. Make sure Node.js is installed:
   ```cmd
   node --version
   ```
   Should show version like `v18.0.0`

2. If not installed, download from: https://nodejs.org/

3. After install, restart Command Prompt and try again

### "php artisan not found"

1. Make sure you're in project directory:
   ```cmd
   cd C:\laragon\www\manajemen-tugas
   ```

2. Check if `artisan` file exists

3. Try: `php artisan --version`

### Database errors

1. Check `.env` file has proper settings
2. Make sure `database/database.sqlite` file exists
3. Try: `php artisan migrate:fresh --seed`

### Port already in use

If port 8000 or 5173 already in use:

```cmd
php artisan serve --port=8001
npm run dev -- --port 5174
```

---

## 📚 More Documentation

- `SETUP_COMPLETE.md` - Full setup instructions
- `READY_TO_USE.md` - Detailed guide
- `START_HERE.md` - Quick overview
- `TROUBLESHOOTING.md` - Common issues

---

## 💡 Pro Tips

1. **Keep batch files handy** - `install.bat` and `run-dev.bat` make everything easier
2. **Use Command Prompt** if PowerShell still causes issues
3. **Keep both terminals open** during development
4. **Hard refresh browser** if changes don't appear: `Ctrl+Shift+R`

---

**Windows setup should now work! 🎉**

Jika masih ada error, lihat `TROUBLESHOOTING.md`
