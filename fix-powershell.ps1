# Task Manager - PowerShell Execution Policy Fix
# Run this as Administrator to fix npm issues

Write-Host ""
Write-Host "╔════════════════════════════════════════════════════════════╗" -ForegroundColor Green
Write-Host "║     FIXING POWERSHELL EXECUTION POLICY                    ║" -ForegroundColor Green
Write-Host "╚════════════════════════════════════════════════════════════╝" -ForegroundColor Green
Write-Host ""

# Check if running as Administrator
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole] "Administrator")

if (-not $isAdmin) {
    Write-Host "ERROR: This script must be run as Administrator!" -ForegroundColor Red
    Write-Host ""
    Write-Host "Instructions:" -ForegroundColor Yellow
    Write-Host "1. Right-click PowerShell"
    Write-Host "2. Select 'Run as Administrator'"
    Write-Host "3. Run this script again"
    Write-Host ""
    Read-Host "Press Enter to exit"
    exit
}

Write-Host "Current Execution Policy: " -ForegroundColor Yellow -NoNewline
Get-ExecutionPolicy
Write-Host ""

Write-Host "Setting Execution Policy to RemoteSigned..." -ForegroundColor Cyan
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser -Force

Write-Host ""
Write-Host "New Execution Policy: " -ForegroundColor Yellow -NoNewline
Get-ExecutionPolicy
Write-Host ""

Write-Host "✅ PowerShell Execution Policy has been fixed!" -ForegroundColor Green
Write-Host ""
Write-Host "You can now run npm commands in PowerShell without errors." -ForegroundColor Green
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Cyan
Write-Host "1. Close this PowerShell window"
Write-Host "2. Open a new PowerShell window"
Write-Host "3. Navigate to your project folder"
Write-Host "4. Run: npm install"
Write-Host ""

Read-Host "Press Enter to exit"
