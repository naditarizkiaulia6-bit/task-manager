# 🔧 Troubleshooting Guide - Task Manager

Common issues & solutions untuk Task Manager.

---

## 🚨 Installation Issues

### Issue: "composer command not found"

**Symptoms**
```
bash: composer: command not found
```

**Cause**: Composer tidak terinstall atau tidak di PATH

**Solutions**:
1. **Install Composer** (Windows):
   - Download dari: https://getcomposer.org/download/
   - Jalankan installer
   - Restart terminal

2. **Install Composer** (macOS):
   ```bash
   brew install composer
   ```

3. **Install Composer** (Linux):
   ```bash
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   php composer-setup.php
   php -r "unlink('composer-setup.php');"
   ```

4. **Verify installation**:
   ```bash
   composer --version
   ```

---

### Issue: "npm command not found"

**Symptoms**
```
bash: npm: command not found
```

**Cause**: Node.js & npm tidak terinstall

**Solutions**:
1. **Install Node.js** (Windows/macOS):
   - Download dari: https://nodejs.org/
   - Install LTS version
   - Restart terminal

2. **Install Node.js** (Linux):
   ```bash
   sudo apt update
   sudo apt install nodejs npm
   ```

3. **Verify installation**:
   ```bash
   node --version
   npm --version
   ```

---

### Issue: "php: command not found"

**Symptoms**
```
bash: php: command not found
```

**Cause**: PHP tidak terinstall atau tidak di PATH

**Solutions**:
1. **Install PHP** (Windows):
   - Download dari: https://windows.php.net/download/
   - Extract & add to PATH
   - Restart terminal

2. **Install PHP** (macOS):
   ```bash
   brew install php
   ```

3. **Install PHP** (Linux):
   ```bash
   sudo apt update
   sudo apt install php php-cli php-json php-common
   ```

4. **Verify installation**:
   ```bash
   php --version
   ```

---

## 📦 Dependencies Issues

### Issue: "autoload.php cannot be found"

**Symptoms**
```
Fatal error: require(../../../vendor/autoload.php)
```

**Cause**: Dependencies tidak diinstall

**Solution**:
```bash
composer install
```

---

### Issue: "npm dependencies are missing"

**Symptoms**
```
Cannot find module 'tailwindcss'
```

**Cause**: NPM packages tidak diinstall

**Solution**:
```bash
npm install
```

---

### Issue: "outdated dependencies"

**Symptoms**
Various compatibility errors

**Solution**:
```bash
# Update all
composer update
npm update

# Or install fresh
composer install --no-cache
npm install --force
```

---

## ⚙️ Configuration Issues

### Issue: ".env file not found"

**Symptoms**
```
No application encryption key has been specified
```

**Cause**: `.env` file tidak ada atau tidak dikonfigurasi

**Solution**:
```bash
# Copy template
cp .env.example .env

# Generate key
php artisan key:generate
```

---

### Issue: "APP_KEY is missing"

**Symptoms**
```
No application encryption key has been specified.
```

**Cause**: APP_KEY belum di-generate

**Solution**:
```bash
php artisan key:generate
```

---

### Issue: "Database connection refused"

**Symptoms**
```
SQLSTATE[HY000]: General error: 1030 Got error 123 from storage engine
```

**Cause**: 
- Database tidak running
- Credentials salah
- Database tidak ada

**Solutions**:

1. **Check database running**:
   ```bash
   # MySQL
   mysql -u root -p
   
   # PostgreSQL
   psql -U postgres
   ```

2. **Verify credentials** in `.env`:
   ```env
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_manager
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Create database** (MySQL):
   ```sql
   CREATE DATABASE task_manager;
   ```

4. **Test connection**:
   ```bash
   php artisan migrate
   ```

---

### Issue: "Wrong database driver"

**Symptoms**
```
Driver not found
```

**Cause**: Database driver tidak sesuai atau PHP extension tidak terinstall

**Solution**:

1. **Install PHP extensions**:
   - MySQL: `php-mysql`
   - PostgreSQL: `php-pgsql`
   - SQLite: `php-sqlite3`

   ```bash
   # macOS
   brew install php@8.2
   
   # Linux
   sudo apt install php-mysql  # or php-pgsql, php-sqlite3
   
   # Windows - edit php.ini
   # Uncomment: extension=pdo_mysql
   ```

2. **Change database** in `.env`:
   ```env
   DB_CONNECTION=mysql      # or postgres, sqlite
   ```

---

## 🗄️ Database Issues

### Issue: "SQLSTATE[HY000]: General error"

**Symptoms**
```
SQLSTATE[HY000]: General error: 17 database disk image is malformed
```

**Cause**: SQLite database corrupted

**Solution**:
```bash
# Backup
cp database/database.sqlite database/database.sqlite.backup

# Delete corrupted
rm database/database.sqlite

# Re-migrate
php artisan migrate
php artisan db:seed --class=TaskSeeder
```

---

### Issue: "Table doesn't exist"

**Symptoms**
```
SQLSTATE[HY000]: General error: 1030 Got error ... table doesn't exist
```

**Cause**: Migrations tidak dijalankan

**Solution**:
```bash
php artisan migrate
```

---

### Issue: "Column doesn't exist"

**Symptoms**
```
SQLSTATE[HY000]: General error: ... no such column: ...
```

**Cause**: Migration baru belum dijalankan

**Solution**:
```bash
# Create migration
php artisan make:migration add_column_to_tasks

# Edit migration file (add column)

# Run migration
php artisan migrate
```

---

### Issue: "Seed data tidak ada"

**Symptoms**
```
No data in database
```

**Cause**: Seeder tidak dijalankan

**Solution**:
```bash
php artisan db:seed --class=TaskSeeder

# Or reset & seed
php artisan migrate:fresh --seed
```

---

## 🎨 Frontend Issues

### Issue: "Tailwind CSS not working"

**Symptoms**
```
Classes not applied, default styles only
```

**Cause**: CSS tidak di-build atau Tailwind tidak configured

**Solutions**:

1. **Build assets**:
   ```bash
   npm run build
   ```

2. **Check vite.config.js** - ensure CSS entry included

3. **Check tailwind.config.js** - ensure content paths correct:
   ```js
   content: [
     "./resources/views/**/*.blade.php",
   ]
   ```

---

### Issue: "Alpine.js not responding"

**Symptoms**
```
Modal doesn't open
@click not working
x-data not reactive
```

**Cause**: 
- Alpine.js not loaded
- Syntax error in Alpine
- Browser cache

**Solutions**:

1. **Check Alpine CDN** in layout:
   ```blade
   <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
   ```

2. **Check browser console** for JavaScript errors

3. **Clear browser cache** (Ctrl+Shift+Del)

4. **Check Alpine syntax**:
   ```blade
   <!-- Correct -->
   <div x-data="{ open: false }" @click="open = true">
   
   <!-- Wrong -->
   <div @click="open = true"> <!-- x-data missing -->
   ```

---

### Issue: "JavaScript errors in console"

**Symptoms**
```
Uncaught ReferenceError: ... is not defined
```

**Cause**: Syntax error or missing code

**Solution**:

1. **Check browser console** (F12)
2. **Look for error line number**
3. **Fix syntax error**
4. **Refresh page**

---

### Issue: "Font not loading"

**Symptoms**
```
Wrong font displayed
```

**Cause**: Font family not configured or CSS not loaded

**Solution**:
```css
/* In app.css */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body {
  font-family: 'Inter', system-ui, sans-serif;
}
```

---

## 🚀 Development Issues

### Issue: "Vite hot reload not working"

**Symptoms**
```
Changes not reflecting on refresh
```

**Cause**: Vite not running or wrong port

**Solution**:

1. **Restart Vite**:
   ```bash
   npm run dev
   ```

2. **Check port** (default 5173):
   ```bash
   npm run dev -- --port 5173
   ```

3. **Hard refresh** (Ctrl+Shift+R)

---

### Issue: "Asset URLs broken"

**Symptoms**
```
404 on CSS/JS files
```

**Cause**: Vite not running or wrong URL

**Solution**:

1. **Ensure Vite running**:
   ```bash
   npm run dev
   ```

2. **Check @vite directive** in blade:
   ```blade
   @vite(['resources/css/app.css', 'resources/js/app.js'])
   ```

3. **Check production** built assets:
   ```bash
   npm run build
   ls -la public/
   ```

---

### Issue: "Port already in use"

**Symptoms**
```
Error: listen EADDRINUSE :::8000
Error: listen EADDRINUSE :::5173
```

**Cause**: Another process using port

**Solutions**:

1. **Kill process on port 8000** (Laravel):
   ```bash
   # Windows
   netstat -ano | findstr :8000
   taskkill /PID <PID> /F
   
   # macOS/Linux
   lsof -ti:8000 | xargs kill -9
   ```

2. **Kill process on port 5173** (Vite):
   ```bash
   # Windows
   netstat -ano | findstr :5173
   taskkill /PID <PID> /F
   
   # macOS/Linux
   lsof -ti:5173 | xargs kill -9
   ```

3. **Use different port**:
   ```bash
   php artisan serve --port=8001
   npm run dev -- --port 5174
   ```

---

## 📝 Controller & Model Issues

### Issue: "Method not found in controller"

**Symptoms**
```
Call to undefined method TaskController::method()
```

**Cause**: Method doesn't exist or typo

**Solution**:
```bash
# Check method exists
grep -n "public function method" app/Http/Controllers/TaskController.php

# If missing, add it
# Edit app/Http/Controllers/TaskController.php
```

---

### Issue: "Model not found"

**Symptoms**
```
Class 'App\Models\Task' not found
```

**Cause**: Model file missing or wrong namespace

**Solution**:
```bash
# Verify file exists
ls app/Models/Task.php

# Verify namespace is correct
head -5 app/Models/Task.php
# Should show: namespace App\Models;
```

---

### Issue: "Mass assignment exception"

**Symptoms**
```
Add [field_name] to fillable property to allow mass assignment
```

**Cause**: Field not in `$fillable` array

**Solution**:
Edit `app/Models/Task.php`:
```php
protected $fillable = [
    'title',
    'description',
    'category',
    'priority',
    'status',
    'due_date',
    'assignee',
    'progress',
    'new_field',  // Add here
];
```

---

## 🔐 Security Issues

### Issue: "CSRF token mismatch"

**Symptoms**
```
419 Page Expired
CSRF token mismatch
```

**Cause**: 
- Form missing @csrf
- Session expired
- Token changed

**Solution**:

1. **Ensure @csrf in form**:
   ```blade
   <form method="POST" action="/tasks">
       @csrf
       <!-- fields -->
   </form>
   ```

2. **Check session config** in `.env`:
   ```env
   SESSION_LIFETIME=120
   ```

3. **Clear sessions**:
   ```bash
   php artisan cache:clear
   php artisan session:clear
   ```

---

### Issue: "Unauthorized action"

**Symptoms**
```
403 Forbidden
This action is unauthorized
```

**Cause**: Authorization policy blocked action

**Solution**:

1. **Check policies** (if using):
   ```bash
   ls app/Policies/
   ```

2. **Or remove policies** if not needed

3. **Check gate/permission** if implemented

---

## 📊 Data Issues

### Issue: "No data showing"

**Symptoms**
```
Empty kanban board
```

**Cause**: 
- No tasks created
- Seeder not run
- Database not connected

**Solution**:

1. **Run seeder**:
   ```bash
   php artisan db:seed --class=TaskSeeder
   ```

2. **Create manually** in browser:
   - Click "Tambah Tugas"
   - Fill form
   - Submit

3. **Verify database**:
   ```bash
   php artisan tinker
   Task::count()
   ```

---

### Issue: "Task not saving"

**Symptoms**
```
Form submits but task not created
```

**Cause**: 
- Validation error
- Database error
- Controller issue

**Solution**:

1. **Check validation** errors:
   ```blade
   @error('field_name')
       {{ $message }}
   @enderror
   ```

2. **Check Laravel log**:
   ```bash
   tail -f storage/logs/laravel.log
   ```

3. **Test with Tinker**:
   ```bash
   php artisan tinker
   Task::create([
       'title' => 'Test',
       'category' => 'dev',
       'priority' => 'high'
   ])
   ```

---

### Issue: "Can't update task status"

**Symptoms**
```
Status not changing
404 error
```

**Cause**: 
- Task ID wrong
- Route not found
- Controller error

**Solution**:

1. **Verify route exists**:
   ```bash
   php artisan route:list | grep tasks
   ```

2. **Check task exists**:
   ```bash
   php artisan tinker
   Task::find(1)  # Replace 1 with ID
   ```

3. **Check form** sends correct data

---

## 📱 Browser Issues

### Issue: "Styles look broken on mobile"

**Symptoms**
```
Layout broken on small screens
```

**Cause**: Responsive classes missing

**Solution**:

1. **Check responsive classes**:
   ```blade
   <!-- Correct -->
   <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
   
   <!-- Add breakpoints -->
   grid-cols-1      /* Mobile */
   md:grid-cols-2   /* Tablet */
   lg:grid-cols-4   /* Desktop */
   ```

2. **Check viewport meta**:
   ```blade
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   ```

---

### Issue: "Cache issues on update"

**Symptoms**
```
Old version showing
Changes not reflected
```

**Cause**: Browser cache

**Solution**:

1. **Hard refresh**:
   - Windows: Ctrl+Shift+R
   - Mac: Cmd+Shift+R

2. **Clear cache**:
   ```bash
   php artisan cache:clear
   php artisan view:clear
   ```

3. **Clear browser cache** (Settings → Clear Data)

---

## 🆘 Advanced Troubleshooting

### Issue: "500 Internal Server Error"

**Symptoms**
```
500 Internal Server Error
```

**Cause**: Server error (check logs)

**Solution**:

1. **Check Laravel log**:
   ```bash
   tail -50 storage/logs/laravel.log
   ```

2. **Enable debug mode** (development only):
   ```env
   APP_DEBUG=true
   ```

3. **Check file permissions**:
   ```bash
   # macOS/Linux
   chmod -R 755 bootstrap/cache
   chmod -R 755 storage
   ```

---

### Issue: "Out of memory"

**Symptoms**
```
PHP Fatal error: Allowed memory size ... exhausted
```

**Cause**: Not enough memory allocated

**Solution**:

1. **Increase memory** in `php.ini`:
   ```ini
   memory_limit = 256M
   ```

2. **Or in artisan**:
   ```bash
   php -d memory_limit=256M artisan command
   ```

---

### Issue: "Class not found"

**Symptoms**
```
Class 'App\Model\Task' not found
```

**Cause**: Namespace or file path wrong

**Solution**:

1. **Check file exists**:
   ```bash
   ls app/Models/Task.php
   ```

2. **Check namespace**:
   ```bash
   head -5 app/Models/Task.php
   # Should be: namespace App\Models;
   ```

3. **Regenerate autoloader**:
   ```bash
   composer dump-autoload
   ```

---

## 📞 Still Need Help?

1. **Check all docs** first
2. **Search error message** on Google
3. **Check Laravel docs** for framework issues
4. **Check Tailwind/Alpine docs** for frontend issues
5. **Review code comments** in source files

---

## 🐛 Reporting Bugs

When reporting issues:

1. **Include error message** (full, not truncated)
2. **Include Laravel log** (last 50 lines)
3. **Include .env** (sanitized, no secrets)
4. **Include steps to reproduce**
5. **Include system info**:
   - PHP version: `php --version`
   - Node version: `node --version`
   - OS: Windows/Mac/Linux

---

**Last Updated**: June 3, 2026  
**Version**: 1.0.0
