<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Messages (Available to all correctly authenticated users mapped securely inside the controller)
    Route::get('/messages', [\App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [\App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

    // AI Career Assessment Module
    Route::get('/student/ai-counsellor', [\App\Http\Controllers\AiAssessmentController::class, 'index'])->name('student.ai.chat');
    Route::post('/student/ai-counsellor/message', [\App\Http\Controllers\AiAssessmentController::class, 'store'])->name('student.ai.store');

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::resource('/admin/users', \App\Http\Controllers\Admin\UserController::class)->except(['show'])->names('admin.users');
    });

    Route::middleware('role:counsellor')->group(function () {
        Route::get('/counsellor/dashboard', [DashboardController::class, 'counsellor'])->name('counsellor.dashboard');

        // Appointment routes
        Route::get('/counsellor/appointments', [App\Http\Controllers\AppointmentController::class, 'indexCounsellor'])->name('counsellor.appointments.index');
        Route::post('/counsellor/appointments/{id}/approve', [App\Http\Controllers\AppointmentController::class, 'approve'])->name('counsellor.appointments.approve');
        Route::post('/counsellor/appointments/{id}/reject', [App\Http\Controllers\AppointmentController::class, 'reject'])->name('counsellor.appointments.reject');
    });

    Route::middleware('role:student')->group(function () {
        Route::get('/student/dashboard', [DashboardController::class, 'student'])->name('student.dashboard');

        // Aptitude test routes
        Route::get('/student/tests', [App\Http\Controllers\AptitudeTestController::class, 'index'])->name('student.tests.index');
        Route::get('/student/tests/{id}', [App\Http\Controllers\AptitudeTestController::class, 'show'])->name('student.tests.show');
        Route::post('/student/tests/{id}', [App\Http\Controllers\AptitudeTestController::class, 'submit'])->name('student.tests.submit');

        // Appointment routes
        Route::get('/student/appointments/create', [App\Http\Controllers\AppointmentController::class, 'create'])->name('student.appointments.create');
        Route::post('/student/appointments', [App\Http\Controllers\AppointmentController::class, 'store'])->name('student.appointments.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
