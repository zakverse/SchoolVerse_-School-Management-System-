<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes - EduManage
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
Route::get('/', function () {
    return view('welcome');
});

// ==================== AUTHENTICATION ROUTES ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==================== 1. POV ADMIN (Protected by Admin Role) ====================
Route::prefix('admin')->middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD Siswa
    Route::get('/data-siswa', [AdminController::class, 'dataSiswa'])->name('admin.datasiswa');
    Route::post('/data-siswa', [AdminController::class, 'storeSiswa'])->name('admin.datasiswa.post');
    Route::put('/data-siswa/{student}', [AdminController::class, 'updateSiswa'])->name('admin.datasiswa.put');
    Route::delete('/data-siswa/{student}', [AdminController::class, 'deleteSiswa'])->name('admin.datasiswa.delete');

    // CRUD Guru
    Route::get('/data-guru', [AdminController::class, 'dataGuru'])->name('admin.dataguru');
    Route::post('/data-guru', [AdminController::class, 'storeGuru'])->name('admin.dataguru.post');
    Route::put('/data-guru/{teacher}', [AdminController::class, 'updateGuru'])->name('admin.dataguru.put');
    Route::delete('/data-guru/{teacher}', [AdminController::class, 'deleteGuru'])->name('admin.dataguru.delete');

    // Jadwal Pelajaran
    Route::get('/jadwal', [AdminController::class, 'schedule'])->name('admin.jadwal');
    Route::post('/jadwal', [AdminController::class, 'storeSchedule'])->name('admin.jadwal.post');
    Route::delete('/jadwal/{schedule}', [AdminController::class, 'deleteSchedule'])->name('admin.jadwal.delete');

    // Absensi
    Route::get('/absensi', [AdminController::class, 'attendance'])->name('admin.absensi');
    Route::post('/absensi', [AdminController::class, 'saveAttendance'])->name('admin.absensi.post');

    // Nilai & Rapor
    Route::get('/nilai', [AdminController::class, 'grades'])->name('admin.nilai');
    Route::post('/nilai', [AdminController::class, 'saveGrades'])->name('admin.nilai.post');

    // Keuangan SPP
    Route::get('/keuangan', [AdminController::class, 'keuangan'])->name('admin.keuangan');
    Route::post('/keuangan/pay', [AdminController::class, 'paySPP'])->name('admin.keuangan.pay');
});    


// ==================== 2. POV TEACHER (Protected by Teacher Role) ====================
Route::prefix('teacher')->middleware([RoleMiddleware::class . ':teacher'])->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/jadwal', [TeacherController::class, 'schedule'])->name('teacher.jadwal');
    Route::get('/absensi', [TeacherController::class, 'attendance'])->name('teacher.absensi');
    Route::post('/absensi', [TeacherController::class, 'saveAttendance'])->name('teacher.absensi.post');
    Route::get('/nilai', [TeacherController::class, 'grades'])->name('teacher.nilai');
    Route::post('/nilai', [TeacherController::class, 'saveGrades'])->name('teacher.nilai.post');
});


// ==================== 3. POV STUDENT (Protected by Student Role) ====================
Route::prefix('student')->middleware([RoleMiddleware::class . ':student'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/jadwal', [StudentController::class, 'schedule'])->name('student.jadwal');
    Route::get('/rapor', [StudentController::class, 'rapor'])->name('student.rapor');
    Route::get('/absensi', [StudentController::class, 'attendance'])->name('student.absensi');
    Route::get('/spp', [StudentController::class, 'spp'])->name('student.spp');
    Route::get('/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::post('/profile/password', [StudentController::class, 'updatePassword'])->name('student.profile.password');
});