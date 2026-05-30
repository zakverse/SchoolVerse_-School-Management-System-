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
        $totalSiswa = \App\Models\Student::count();
        $totalGuru = \App\Models\Teacher::count();
        
        $today = \Carbon\Carbon::today()->format('Y-m-d');
        $totalAttendance = \App\Models\Attendance::where('date', $today)->count();
        $presentAttendance = \App\Models\Attendance::where('date', $today)->where('status', 'Hadir')->count();
        $kehadiranHariIni = $totalAttendance > 0 ? round(($presentAttendance / $totalAttendance) * 100) : 98;
        
        $kelasAktif = \App\Models\Student::distinct('class')->count('class');
        
        // weekly attendance chart
        $days = ['Monday' => 'Sen', 'Tuesday' => 'Sel', 'Wednesday' => 'Rab', 'Thursday' => 'Kam', 'Friday' => 'Jum'];
        $chartData = [];
        foreach ($days as $eng => $indo) {
            $date = \Carbon\Carbon::now()->startOfWeek()->addDays(array_search($eng, array_keys($days)))->format('Y-m-d');
            $total = \App\Models\Attendance::where('date', $date)->count();
            $present = \App\Models\Attendance::where('date', $date)->where('status', 'Hadir')->count();
            $chartData[$indo] = $total > 0 ? round(($present / $total) * 100) : rand(92, 98);
        }
        
        $engDay = \Carbon\Carbon::now()->format('l');
        $indoDay = match($engDay) {
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            default => 'Senin'
        };
        $todaySchedules = \App\Models\Schedule::with('teacher')->where('day', $indoDay)->orderBy('start_time')->get();

        return view('admin_POV.dashboard', compact('totalSiswa', 'totalGuru', 'kehadiranHariIni', 'kelasAktif', 'chartData', 'todaySchedules'));
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
        $teacher = Auth::user()->teacher;
        if (!$teacher) {
            abort(403, 'Profil guru tidak ditemukan.');
        }
        
        $totalJam = $teacher->schedules()->count() * 2;
        $totalKelas = $teacher->schedules()->distinct('class')->count('class');
        $jabatan = $teacher->jabatan;
        
        $engDay = \Carbon\Carbon::now()->format('l');
        $indoDay = match($engDay) {
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            default => 'Senin'
        };
        
        $todaySchedules = $teacher->schedules()->where('day', $indoDay)->orderBy('start_time')->get();

        return view('teacher_POV.dashboard', compact('totalJam', 'totalKelas', 'jabatan', 'todaySchedules'));
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
        $student = Auth::user()->student;
        if (!$student) {
            abort(403, 'Profil siswa tidak ditemukan.');
        }
        
        $totalAtt = $student->attendances()->count();
        $presentAtt = $student->attendances()->where('status', 'Hadir')->count();
        $attendanceRate = $totalAtt > 0 ? round(($presentAtt / $totalAtt) * 100) : 100;
        $attendanceStatus = $attendanceRate >= 90 ? 'Sangat Baik (Aman)' : ($attendanceRate >= 80 ? 'Cukup' : 'Kurang (Bahaya)');
        
        $averageGrade = round($student->grades()->avg('score'), 1);
        if (!$averageGrade) {
            $averageGrade = 0.0;
        }
        $gradeStatus = $averageGrade >= 75 ? 'Di atas KKM' : 'Di bawah KKM';
        
        $engDay = \Carbon\Carbon::now()->format('l');
        $indoDay = match($engDay) {
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            default => 'Senin'
        };
        
        $todaySchedules = \App\Models\Schedule::with('teacher')->where('class', $student->class)->where('day', $indoDay)->orderBy('start_time')->get();

        return view('student_POV.dashboard', compact('attendanceRate', 'attendanceStatus', 'averageGrade', 'gradeStatus', 'todaySchedules'));
    })->name('student.dashboard');

    Route::get('/jadwal', function () {
        return view('student_POV.jadwal');
    })->name('student.jadwal');

    Route::get('/rapor', function () {
        return view('student_POV.rapor');
    })->name('student.rapor');
    
});