<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    
    Route::get('/dashboard', function () {
        return view('admin_POV.dashboard');
    })->name('admin.dashboard');

    Route::get('/data-siswa', function () {
        return view('admin_POV.datasiswa');
    })->name('admin.datasiswa');

    Route::get('/data-guru', function () {
        return view('admin_POV.dataguru');
    })->name('admin.dataguru');

    Route::get('/jadwal', function () {
        return view('admin_POV.jadwalpelajaran');
    })->name('admin.jadwal');

    Route::get('/keuangan', function () {
        return view('admin_POV.keuanganSPP');
    })->name('admin.keuangan');
    
});    


// ==================== 2. POV TEACHER (Protected by Teacher Role) ====================
Route::prefix('teacher')->middleware([RoleMiddleware::class . ':teacher'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('teacher_POV.dashboard');
    })->name('teacher.dashboard');

    Route::get('/jadwal', function () {
        return view('teacher_POV.jadwal');
    })->name('teacher.jadwal');

    Route::get('/absensi', function () {
        return view('teacher_POV.absensi');
    })->name('teacher.absensi');

    Route::get('/nilai', function () {
        return view('teacher_POV.nilai');
    })->name('teacher.nilai');
    
});


// ==================== 3. POV STUDENT (Protected by Student Role) ====================
Route::prefix('student')->middleware([RoleMiddleware::class . ':student'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('student_POV.dashboard');
    })->name('student.dashboard');

    Route::get('/jadwal', function () {
        return view('student_POV.jadwal');
    })->name('student.jadwal');

    Route::get('/rapor', function () {
        return view('student_POV.rapor');
    })->name('student.rapor');
    
});