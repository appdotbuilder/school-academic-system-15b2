<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Public home page
Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Students management
    Route::resource('students', StudentController::class);
    
    // Teachers management
    Route::resource('teachers', TeacherController::class);
    
    // Teacher attendance management
    Route::resource('attendances', TeacherAttendanceController::class);
    
    // Lesson scheduling and management
    Route::resource('lessons', LessonController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';