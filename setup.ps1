# nPunto Activity Tracker - PowerShell Setup Script
# This script sets up the application for development/production

Write-Host ""
Write-Host "============================================"
Write-Host "nPunto Activity Tracker - Setup"
Write-Host "============================================"
Write-Host ""

# Check if .env exists
if (Test-Path ".env") {
    Write-Host ".env file already exists. Skipping..."
} else {
    Write-Host "Creating .env file from .env.example..."
    Copy-Item ".env.example" -Destination ".env"
    Write-Host ".env file created successfully."
}

# Check if vendor exists
if (-not (Test-Path "vendor")) {
    Write-Host "Installing composer dependencies..."
    & composer install
} else {
    Write-Host "Composer dependencies already installed."
}

Write-Host ""
Write-Host "============================================"
Write-Host "Database Setup"
Write-Host "============================================"
Write-Host ""
Write-Host "Please ensure MySQL is running in Laragon."
Write-Host ""
Write-Host "Create a database with the following command in MySQL:"
Write-Host "  CREATE DATABASE npunto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
Write-Host ""
Read-Host "Press Enter when database is created to continue"

Write-Host ""
Write-Host "Generating application key..."
& php artisan key:generate

Write-Host ""
Write-Host "Running migrations..."
& php artisan migrate

Write-Host ""
Write-Host "Seeding database with initial data..."
& php artisan db:seed

Write-Host ""
Write-Host "============================================"
Write-Host "Setup Complete!"
Write-Host "============================================"
Write-Host ""
Write-Host "You can now start the development server with:"
Write-Host "  php artisan serve"
Write-Host ""
Write-Host "Default login credentials:"
Write-Host "  Email: admin@npunto.local"
Write-Host "  Password: password"
Write-Host ""
Write-Host "Visit http://localhost:8000 after starting the server."
Write-Host ""
Read-Host "Press Enter to exit"
