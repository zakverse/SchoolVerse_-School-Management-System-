<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Schedule;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display student dashboard.
     */
    public function dashboard()
    {
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
        
        $engDay = Carbon::now()->format('l');
        $indoDay = match($engDay) {
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            default => 'Senin'
        };
        
        $todaySchedules = Schedule::with('teacher')->where('class', $student->class)->where('day', $indoDay)->orderBy('start_time')->get();

        return view('student_POV.dashboard', compact('attendanceRate', 'attendanceStatus', 'averageGrade', 'gradeStatus', 'todaySchedules'));
    }

    /**
     * Display student's schedule.
     */
    public function schedule()
    {
        $student = Auth::user()->student;
        if (!$student) {
            abort(403, 'Profil siswa tidak ditemukan.');
        }

        $schedules = Schedule::with('teacher')->where('class', $student->class)->get();

        return view('student_POV.jadwal', compact('schedules'));
    }

    /**
     * Display student's grade transcript (Rapor).
     */
    public function rapor()
    {
        $student = Auth::user()->student;
        if (!$student) {
            abort(403, 'Profil siswa tidak ditemukan.');
        }

        $subjects = ['Matematika', 'Bahasa Inggris', 'Fisika', 'Kimia', 'Biologi'];
        $raporData = [];

        foreach ($subjects as $sub) {
            $subGrades = $student->grades()->where('subject', $sub)->get();

            $tugas = round($subGrades->whereIn('category', ['Tugas', 'Praktikum', 'Proyek'])->avg('score'));
            $uts = round($subGrades->where('category', 'UTS')->avg('score'));
            $uas = round($subGrades->where('category', 'UAS')->avg('score'));

            $components = array_filter([$tugas, $uts, $uas]);
            $nilaiAkhir = count($components) > 0 ? round(array_sum($components) / count($components), 1) : 0;

            $raporData[] = [
                'subject' => $sub,
                'tugas' => $tugas > 0 ? $tugas : '-',
                'uts' => $uts > 0 ? $uts : '-',
                'uas' => $uas > 0 ? $uas : '-',
                'nilai_akhir' => $nilaiAkhir > 0 ? $nilaiAkhir : '-',
                'status' => $nilaiAkhir >= 75 ? 'Lulus' : ($nilaiAkhir > 0 ? 'Remedial' : '-'),
            ];
        }

        return view('student_POV.rapor', compact('raporData'));
    }
}
