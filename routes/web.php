<?php

use Illuminate\Support\Facades\Route;

// Redirect root ke halaman login agar lebih rapi
Route::get('/', function () {
    return redirect('/login');
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