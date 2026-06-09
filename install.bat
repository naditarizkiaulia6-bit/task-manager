@echo off
REM Task Manager - Installation Script
REM This script will install all dependencies

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║       TASK MANAGER - INSTALLATION SCRIPT                  ║
echo ╚════════════════════════════════════════════════════════════╝
echo.

REM Step 1: NPM Install
echo [1/5] Installing NPM dependencies...
call npm install
if %errorlevel% neq 0 (
    echo ERROR: npm install failed
    pause
    exit /b 1
)
echo ✓ NPM dependencies installed
echo.

REM Step 2: Database Migration
echo [2/5] Running database migrations...
call php artisan migrate
if %errorlevel% neq 0 (
    echo ERROR: Migration failed
    pause
    exit /b 1
)
echo ✓ Database migrated
echo.

REM Step 3: Database Seeding
echo [3/5] Seeding sample data...
call php artisan db:seed --class=TaskSeeder
if %errorlevel% neq 0 (
    echo ERROR: Seeding failed
    pause
    exit /b 1
)
echo ✓ Sample data seeded
echo.

REM Step 4: Build Assets
echo [4/5] Building frontend assets...
call npm run build
if %errorlevel% neq 0 (
    echo ERROR: Build failed
    pause
    exit /b 1
)
echo ✓ Assets built
echo.

REM Step 5: Success
echo [5/5] Installation complete!
echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║              INSTALLATION SUCCESSFUL! ✅                   ║
echo ╚════════════════════════════════════════════════════════════╝
echo.
echo Next steps:
echo.
echo 1. Open Terminal 1 and run:
echo    npm run dev
echo.
echo 2. Open Terminal 2 and run:
echo    php artisan serve
echo.
echo 3. Open browser:
echo    http://localhost:8000
echo.
pause
