<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TutorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Tutor\AttendanceController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use Illuminate\Support\Facades\Route;

// ---------- Public Website ----------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/admission-inquiry', [HomeController::class, 'storeInquiry'])->name('inquiry.store');

// ---------- Auth ----------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ---------- Change Password (Admin + Tutor dono) ----------
Route::middleware('auth')->group(function () {
    Route::get('/profile/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/profile/password', [PasswordController::class, 'update'])->name('password.update');
});

// ---------- Admin Panel ----------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('students', StudentController::class);
    Route::resource('tutors', TutorController::class);

    Route::get('/fees', [FeeController::class, 'index'])->name('fees.index');
    Route::post('/fees/generate', [FeeController::class, 'generate'])->name('fees.generate');
    Route::post('/fees/{fee}/update-status', [FeeController::class, 'updateStatus'])->name('fees.updateStatus');
    Route::get('/fees/{fee}/receipt', [FeeController::class, 'receipt'])->name('fees.receipt');

    Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::post('/inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.updateStatus');
});

// ---------- Tutor Panel ----------
Route::middleware(['auth', 'role:tutor'])->prefix('tutor')->name('tutor.')->group(function () {
    Route::get('/dashboard', [TutorDashboardController::class, 'index'])->name('dashboard');

    Route::get('/attendance/select', [AttendanceController::class, 'selectForm'])->name('attendance.select');
    Route::get('/attendance/mark', [AttendanceController::class, 'markForm'])->name('attendance.mark');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/history', [AttendanceController::class, 'history'])->name('attendance.history');
});
