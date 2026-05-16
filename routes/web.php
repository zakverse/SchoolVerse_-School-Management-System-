<?php

use Illuminate\Support\Facades\Route;

// Redirect root ke halaman login agar lebih rapi
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Simulasi: Berhasil login langsung ke dashboard
    return redirect()->route('admin_POV.dashboard');
})->name('login.post');

// Admin Routes - Gunakan group agar lebih terorganisir
Route::prefix('admin')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin_POV.dashboard');
    })->name('admin_POV.dashboard'); // Berikan nama rute di sini

    Route::get('/data-siswa', function () {
        return view('admin_POV.datasiswa');
    })->name('admin_POV.datasiswa');

    Route::get('/data-guru', function () {
        return view('admin_POV.dataguru');
    })->name('admin_POV.dataguru');

    Route::get('/jadwal', function () {
        return view('admin_POV.jadwalpelajaran');
    })->name('admin_POV.jadwal');

    Route::get('/keuangan', function () {
        return view('admin_POV.keuanganSPP');
    })->name('admin_POV.keuangan');
});    

    // Teacher Routes Group
Route::prefix('teacher')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('teacher_POV.dashboard');
    })->name('teacher_POV.dashboard');

    Route::get('/jadwal', function () {
        return view('teacher_POV.jadwal');
    })->name('teacher_POV.jadwal');

    Route::get('/absensi', function () {
        return view('teacher_POV.absensi');
    })->name('teacher_POV.absensi');

    Route::get('/nilai', function () {
        return view('teacher_POV.nilai');
    })->name('teacher_POV.nilai');
    
});

