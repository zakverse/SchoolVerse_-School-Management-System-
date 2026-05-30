<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TeacherController extends Controller
{
    /**
     * Display teacher dashboard.
     */
    public function dashboard()
    {
        $teacher = Auth::user()->teacher;
        if (!$teacher) {
            abort(403, 'Profil guru tidak ditemukan.');
        }
        
        $totalJam = $teacher->schedules()->count() * 2;
        $totalKelas = $teacher->schedules()->distinct('class')->count('class');
        $jabatan = $teacher->jabatan;
        
        $engDay = Carbon::now()->format('l');
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
    }

    /**
     * Display teacher's schedule.
     */
    public function schedule()
    {
        $teacher = Auth::user()->teacher;
        if (!$teacher) {
            abort(403, 'Profil guru tidak ditemukan.');
        }

        $schedules = $teacher->schedules;
        $totalJam = $schedules->count() * 2;

        return view('teacher_POV.jadwal', compact('schedules', 'totalJam'));
    }

    /**
     * Display teacher's class attendance.
     */
    public function attendance(Request $request)
    {
        $teacher = Auth::user()->teacher;
        if (!$teacher) {
            abort(403, 'Profil guru tidak ditemukan.');
        }

        $schedules = $teacher->schedules;
        if ($schedules->isEmpty()) {
            return view('teacher_POV.absensi', [
                'schedules' => collect(),
                'activeSchedule' => null,
                'students' => collect(),
                'todayLogs' => [],
                'stats' => ['Hadir' => 0, 'Izin' => 0, 'Sakit' => 0, 'Alpa' => 0]
            ]);
        }

        // Active schedule determined by query param or default to first schedule
        $activeScheduleId = $request->input('schedule_id', $schedules->first()->id);
        $activeSchedule = $schedules->firstWhere('id', $activeScheduleId) ?? $schedules->first();

        // Get students in this class
        $students = Student::where('class', $activeSchedule->class)->where('status', 'active')->orderBy('name')->get();

        // Get today's attendance logs for this schedule
        $today = Carbon::today()->format('Y-m-d');
        $attendances = Attendance::where('schedule_id', $activeSchedule->id)
            ->where('date', $today)
            ->get();

        $todayLogs = $attendances->pluck('status', 'student_id')->toArray();

        // Calculate statistics
        $stats = [
            'Hadir' => $attendances->where('status', 'Hadir')->count(),
            'Izin' => $attendances->where('status', 'Izin')->count(),
            'Sakit' => $attendances->where('status', 'Sakit')->count(),
            'Alpa' => $attendances->where('status', 'Alpa')->count(),
        ];

        // If no records saved yet, set default statistics (total students = Hadir)
        if ($attendances->isEmpty()) {
            $stats['Hadir'] = $students->count();
        }

        return view('teacher_POV.absensi', compact('schedules', 'activeSchedule', 'students', 'todayLogs', 'stats'));
    }

    /**
     * Save class attendance.
     */
    public function saveAttendance(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'status' => 'required|array',
        ]);

        $scheduleId = $request->input('schedule_id');
        $statusData = $request->input('status'); // student_id => H/I/S/A

        $statusMap = [
            'H' => 'Hadir',
            'I' => 'Izin',
            'S' => 'Sakit',
            'A' => 'Alpa',
        ];

        $today = Carbon::today()->format('Y-m-d');

        foreach ($statusData as $studentId => $statusVal) {
            $status = $statusMap[$statusVal] ?? 'Hadir';

            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'schedule_id' => $scheduleId,
                    'date' => $today,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data presensi hari ini berhasil disimpan.');
    }

    /**
     * Display teacher's grades input panel.
     */
    public function grades(Request $request)
    {
        $teacher = Auth::user()->teacher;
        if (!$teacher) {
            abort(403, 'Profil guru tidak ditemukan.');
        }

        // Get classes the teacher teaches
        $classes = $teacher->schedules()->distinct('class')->pluck('class');
        if ($classes->isEmpty()) {
            return view('teacher_POV.nilai', [
                'classes' => collect(),
                'activeClass' => null,
                'activeCategory' => 'Tugas',
                'students' => collect(),
                'gradesData' => [],
                'stats' => ['avg' => 0, 'max' => 0, 'min' => 0, 'remedial' => 0]
            ]);
        }

        $activeClass = $request->input('class', $classes->first());
        $activeCategory = $request->input('category', 'Tugas');

        // Fetch students in active class
        $students = Student::where('class', $activeClass)->where('status', 'active')->orderBy('name')->get();

        // Get grades for the subject and category
        $grades = Grade::whereIn('student_id', $students->pluck('id'))
            ->where('subject', $teacher->mapel)
            ->where('category', $activeCategory)
            ->get();

        $gradesData = [];
        foreach ($grades as $grade) {
            $gradesData[$grade->student_id] = [
                'score' => $grade->score,
                'notes' => $grade->notes,
            ];
        }

        // Calculate statistics
        $scores = $grades->pluck('score');
        $stats = [
            'avg' => $scores->isNotEmpty() ? round($scores->average(), 1) : 0,
            'max' => $scores->isNotEmpty() ? $scores->max() : 0,
            'min' => $scores->isNotEmpty() ? $scores->min() : 0,
            'remedial' => $grades->where('score', '<', 75)->count(),
        ];

        return view('teacher_POV.nilai', compact('classes', 'activeClass', 'activeCategory', 'students', 'gradesData', 'stats'));
    }

    /**
     * Save student grades.
     */
    public function saveGrades(Request $request)
    {
        $request->validate([
            'class' => 'required',
            'category' => 'required',
            'grades' => 'required|array',
        ]);

        $teacher = Auth::user()->teacher;
        if (!$teacher) {
            abort(403, 'Profil guru tidak ditemukan.');
        }

        $category = $request->input('category');
        $gradesInput = $request->input('grades'); // student_id => [score, notes]

        foreach ($gradesInput as $studentId => $data) {
            $score = $data['score'] ?? 0;
            $notes = $data['notes'] ?? null;

            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'subject' => $teacher->mapel,
                    'category' => $category,
                ],
                [
                    'score' => $score,
                    'notes' => $notes,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data nilai berhasil disimpan.');
    }
}
