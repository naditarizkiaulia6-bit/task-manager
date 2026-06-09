@echo off
REM Task Manager - Development Server Launcher
REM This will prompt user which server to start

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║         TASK MANAGER - DEVELOPMENT SERVER                 ║
echo ╚════════════════════════════════════════════════════════════╝
echo.
echo Choose which server to start:
echo.
echo 1. Vite Dev Server (npm run dev)
echo 2. Laravel Server (php artisan serve)
echo 3. Open Both (run both in new windows)
echo.

set /p choice="Enter your choice (1-3): "

if "%choice%"=="1" (
    echo Starting Vite dev server...
    echo.
    npm run dev
) else if "%choice%"=="2" (
    echo Starting Laravel server...
    echo.
    php artisan serve
) else if "%choice%"=="3" (
    echo Opening both servers...
    echo.
    start "Vite Dev Server" cmd /k "npm run dev"
    timeout /t 2 /nobreak
    start "Laravel Server" cmd /k "php artisan serve"
    echo.
    echo Both servers started in new windows!
    echo.
    echo Vite running at: http://localhost:5173
    echo Laravel running at: http://localhost:8000
    echo.
    echo Open your browser: http://localhost:8000
    echo.
    pause
) else (
    echo Invalid choice. Please run again and select 1, 2, or 3.
    pause
)
