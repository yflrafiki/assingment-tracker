<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\ReportController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Protected routes - require authentication
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Activities management
    Route::resource('activities', ActivityController::class);

    // Daily view
    Route::get('daily', [DailyController::class, 'index'])->name('daily.index');
    Route::get('daily/handover', [DailyController::class, 'handover'])->name('daily.handover');

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/summary', [ReportController::class, 'summary'])->name('reports.summary');
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');

    // API endpoint for modal
    Route::get('activities/{activity}/modal', [ActivityController::class, 'getActivityModal']);
});
