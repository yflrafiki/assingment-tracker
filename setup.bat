@echo off
REM nPunto Activity Tracker - Setup Script
REM This script sets up the application for development/production

echo.
echo ============================================
echo nPunto Activity Tracker - Setup
echo ============================================
echo.

REM Check if .env exists
if exist .env (
    echo .env file already exists. Skipping...
) else (
    echo Creating .env file from .env.example...
    copy .env.example .env
    echo .env file created successfully.
)

REM Check if vendor exists
if not exist vendor (
    echo Installing composer dependencies...
    call composer install
) else (
    echo Composer dependencies already installed.
)

echo.
echo ============================================
echo Database Setup
echo ============================================
echo.
echo Please ensure MySQL is running in Laragon.
echo.
echo Create a database with the following command in MySQL:
echo   CREATE DATABASE npunto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
echo.
echo Then come back here and press a key to continue...
pause

echo.
echo Generating application key...
call php artisan key:generate

echo.
echo Running migrations...
call php artisan migrate

echo.
echo Seeding database with initial data...
call php artisan db:seed

echo.
echo ============================================
echo Setup Complete!
echo ============================================
echo.
echo You can now start the development server with:
echo   php artisan serve
echo.
echo Default login credentials:
echo   Email: admin@npunto.local
echo   Password: password
echo.
echo Visit http://localhost:8000 after starting the server.
echo.
pause
