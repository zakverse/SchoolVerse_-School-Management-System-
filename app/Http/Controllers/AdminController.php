<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\SppPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Admin Dashboard.
     */
    public function dashboard()
    {
        $totalSiswa = Student::count();
        $totalGuru = Teacher::count();
        
        $today = Carbon::today()->format('Y-m-d');
        $totalAttendance = Attendance::where('date', $today)->count();
        $presentAttendance = Attendance::where('date', $today)->where('status', 'Hadir')->count();
        $kehadiranHariIni = $totalAttendance > 0 ? round(($presentAttendance / $totalAttendance) * 100) : 98;
        
        $kelasAktif = Student::distinct('class')->count('class');
        
        // Weekly attendance chart
        $days = ['Monday' => 'Sen', 'Tuesday' => 'Sel', 'Wednesday' => 'Rab', 'Thursday' => 'Kam', 'Friday' => 'Jum'];
        $chartData = [];
        foreach ($days as $eng => $indo) {
            $date = Carbon::now()->startOfWeek()->addDays(array_search($eng, array_keys($days)))->format('Y-m-d');
            $total = Attendance::where('date', $date)->count();
            $present = Attendance::where('date', $date)->where('status', 'Hadir')->count();
            $chartData[$indo] = $total > 0 ? round(($present / $total) * 100) : rand(92, 98);
        }
        
        $engDay = Carbon::now()->format('l');
        $indoDay = match($engDay) {
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            default => 'Senin'
        };
        $todaySchedules = Schedule::with('teacher')->where('day', $indoDay)->orderBy('start_time')->get();

        return view('admin_POV.dashboard', compact('totalSiswa', 'totalGuru', 'kehadiranHariIni', 'kelasAktif', 'chartData', 'todaySchedules'));
    }

    /**
     * Data Siswa.
     */
    public function dataSiswa(Request $request)
    {
        $search = $request->input('search');
        $classFilter = $request->input('class');
        $classes = Student::distinct()->orderBy('class')->pluck('class');

        $query = Student::query();
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }
        if ($classFilter) {
            $query->where('class', $classFilter);
        }

        $students = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('admin_POV.datasiswa', compact('students', 'classes', 'search', 'classFilter'));
    }

    /**
     * Store new Siswa.
     */
    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:students,nis',
            'name' => 'required|string|max:255',
            'class' => 'required|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
        ]);

        DB::transaction(function() use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => 'student.' . $request->nis . '@edumanage.com',
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'name' => $request->name,
                'class' => $request->class,
                'gender' => $request->gender,
                'status' => 'active',
            ]);

            // Seed initial SPP payments for the new student
            $months = [1, 2, 3, 4, 5];
            foreach ($months as $m) {
                SppPayment::create([
                    'student_id' => $user->student->id,
                    'month' => $m,
                    'year' => 2026,
                    'amount' => 350000.00,
                    'status' => 'Belum Lunas',
                ]);
            }
        });

        return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Update Siswa.
     */
    public function updateSiswa(Request $request, Student $student)
    {
        $request->validate([
            'nis' => 'required|unique:students,nis,' . $student->id,
            'name' => 'required|string|max:255',
            'class' => 'required|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|in:active,inactive',
        ]);

        DB::transaction(function() use ($request, $student) {
            if ($student->user) {
                $student->user->update([
                    'name' => $request->name,
                    'email' => 'student.' . $request->nis . '@edumanage.com',
                ]);
            }
            $student->update([
                'nis' => $request->nis,
                'name' => $request->name,
                'class' => $request->class,
                'gender' => $request->gender,
                'status' => $request->status,
            ]);
        });

        return redirect()->back()->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Delete Siswa.
     */
    public function deleteSiswa(Student $student)
    {
        DB::transaction(function() use ($student) {
            $user = $student->user;
            $student->delete();
            if ($user) {
                $user->delete();
            }
        });

        return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
    }

    /**
     * Data Guru.
     */
    public function dataGuru(Request $request)
    {
        $search = $request->input('search');
        $mapelFilter = $request->input('mapel');
        $mapels = Teacher::distinct()->orderBy('mapel')->pluck('mapel');

        $query = Teacher::query();
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }
        if ($mapelFilter) {
            $query->where('mapel', $mapelFilter);
        }

        $teachers = $query->orderBy('name')->paginate(12)->withQueryString();

        return view('admin_POV.dataguru', compact('teachers', 'mapels', 'search', 'mapelFilter'));
    }

    /**
     * Store new Guru.
     */
    public function storeGuru(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:teachers,nip',
            'name' => 'required|string|max:255',
            'mapel' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        DB::transaction(function() use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => 'teacher.' . $request->nip . '@edumanage.com',
                'password' => Hash::make('12345678'),
                'role' => 'teacher',
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'name' => $request->name,
                'mapel' => $request->mapel,
                'jabatan' => $request->jabatan,
                'status' => 'active',
            ]);
        });

        return redirect()->back()->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Update Guru.
     */
    public function updateGuru(Request $request, Teacher $teacher)
    {
        $request->validate([
            'nip' => 'required|unique:teachers,nip,' . $teacher->id,
            'name' => 'required|string|max:255',
            'mapel' => 'required|string',
            'jabatan' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        DB::transaction(function() use ($request, $teacher) {
            if ($teacher->user) {
                $teacher->user->update([
                    'name' => $request->name,
                    'email' => 'teacher.' . $request->nip . '@edumanage.com',
                ]);
            }
            $teacher->update([
                'nip' => $request->nip,
                'name' => $request->name,
                'mapel' => $request->mapel,
                'jabatan' => $request->jabatan,
                'status' => $request->status,
            ]);
        });

        return redirect()->back()->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Delete Guru.
     */
    public function deleteGuru(Teacher $teacher)
    {
        DB::transaction(function() use ($teacher) {
            $user = $teacher->user;
            $teacher->delete();
            if ($user) {
                $user->delete();
            }
        });

        return redirect()->back()->with('success', 'Data guru berhasil dihapus.');
    }

    /**
     * Jadwal Pelajaran (Schedule).
     */
    public function schedule(Request $request)
    {
        $classes = Student::distinct()->orderBy('class')->pluck('class');
        $activeClass = $request->input('class', $classes->first() ?? 'X MIPA 1');
        
        $teachers = Teacher::where('status', 'active')->orderBy('name')->get();
        $schedules = Schedule::with('teacher')->where('class', $activeClass)->get();

        return view('admin_POV.jadwalpelajaran', compact('schedules', 'classes', 'activeClass', 'teachers'));
    }

    /**
     * Store Schedule.
     */
    public function storeSchedule(Request $request)
    {
        $request->validate([
            'class' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
            'subject' => 'required|string',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required|string',
        ]);

        Schedule::create([
            'class' => $request->class,
            'teacher_id' => $request->teacher_id,
            'subject' => $request->subject,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'room' => $request->room,
        ]);

        return redirect()->back()->with('success', 'Jadwal pelajaran berhasil ditambahkan.');
    }

    /**
     * Delete Schedule.
     */
    public function deleteSchedule(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('success', 'Jadwal pelajaran berhasil dihapus.');
    }

    /**
     * Absensi (Attendance).
     */
    public function attendance(Request $request)
    {
        $classes = Student::distinct()->orderBy('class')->pluck('class');
        $activeClass = $request->input('class', $classes->first() ?? 'X MIPA 1');
        $activeDate = $request->input('date', Carbon::today()->format('Y-m-d'));

        $schedules = Schedule::where('class', $activeClass)->get();
        $activeScheduleId = $request->input('schedule_id', $schedules->first()->id ?? null);
        $activeSchedule = $schedules->firstWhere('id', $activeScheduleId);

        $students = Student::where('class', $activeClass)->where('status', 'active')->orderBy('name')->get();

        $todayLogs = [];
        if ($activeSchedule) {
            $todayLogs = Attendance::where('schedule_id', $activeSchedule->id)
                ->where('date', $activeDate)
                ->get()
                ->pluck('status', 'student_id')
                ->toArray();
        }

        return view('admin_POV.absensi', compact('classes', 'activeClass', 'activeDate', 'schedules', 'activeSchedule', 'activeScheduleId', 'students', 'todayLogs'));
    }

    /**
     * Save Attendance (Admin).
     */
    public function saveAttendance(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'date' => 'required|date',
            'status' => 'required|array',
        ]);

        $scheduleId = $request->input('schedule_id');
        $date = $request->input('date');
        $statusData = $request->input('status'); // student_id => H/I/S/A

        $statusMap = [
            'H' => 'Hadir',
            'I' => 'Izin',
            'S' => 'Sakit',
            'A' => 'Alpa',
        ];

        foreach ($statusData as $studentId => $statusVal) {
            $status = $statusMap[$statusVal] ?? 'Hadir';
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'schedule_id' => $scheduleId,
                    'date' => $date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->back()->with('success', 'Catatan absensi berhasil diperbarui.');
    }

    /**
     * Grades Report.
     */
    public function grades(Request $request)
    {
        $classes = Student::distinct()->orderBy('class')->pluck('class');
        $activeClass = $request->input('class', $classes->first() ?? 'X MIPA 1');
        $subjects = ['Matematika', 'Bahasa Inggris', 'Fisika', 'Kimia', 'Biologi'];
        $activeSubject = $request->input('subject', 'Matematika');
        $categories = ['Tugas', 'UTS', 'UAS', 'Praktikum', 'Proyek'];
        $activeCategory = $request->input('category', 'Tugas');

        $students = Student::where('class', $activeClass)->where('status', 'active')->orderBy('name')->get();

        $grades = Grade::whereIn('student_id', $students->pluck('id'))
            ->where('subject', $activeSubject)
            ->where('category', $activeCategory)
            ->get();

        $gradesData = [];
        foreach ($grades as $grade) {
            $gradesData[$grade->student_id] = [
                'score' => $grade->score,
                'notes' => $grade->notes,
            ];
        }

        return view('admin_POV.nilairapor', compact('classes', 'activeClass', 'subjects', 'activeSubject', 'categories', 'activeCategory', 'students', 'gradesData'));
    }

    /**
     * Save/Edit grades (Admin).
     */
    public function saveGrades(Request $request)
    {
        $request->validate([
            'class' => 'required',
            'subject' => 'required',
            'category' => 'required',
            'grades' => 'required|array',
        ]);

        $subject = $request->input('subject');
        $category = $request->input('category');
        $gradesInput = $request->input('grades'); // student_id => [score, notes]

        foreach ($gradesInput as $studentId => $data) {
            $score = $data['score'] ?? 0;
            $notes = $data['notes'] ?? null;

            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'subject' => $subject,
                    'category' => $category,
                ],
                [
                    'score' => $score,
                    'notes' => $notes,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data nilai berhasil diperbarui.');
    }

    /**
     * Keuangan SPP.
     */
    public function keuangan(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $totalIncome = SppPayment::where('month', $currentMonth)->where('year', $currentYear)->where('status', 'Lunas')->sum('amount');
        $activeArrearsCount = SppPayment::where('month', $currentMonth)->where('year', $currentYear)->where('status', 'Belum Lunas')->count();
        $totalArrears = SppPayment::where('month', $currentMonth)->where('year', $currentYear)->where('status', 'Belum Lunas')->sum('amount');

        $search = $request->input('search');
        $classFilter = $request->input('class');
        $statusFilter = $request->input('status');

        $classes = Student::distinct()->orderBy('class')->pluck('class');

        $query = SppPayment::with('student')->where('month', $currentMonth)->where('year', $currentYear);

        if ($search) {
            $query->whereHas('student', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }
        if ($classFilter) {
            $query->whereHas('student', function($q) use ($classFilter) {
                $q->where('class', $classFilter);
            });
        }
        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        $payments = $query->paginate(10)->withQueryString();

        return view('admin_POV.keuanganSPP', compact('totalIncome', 'activeArrearsCount', 'totalArrears', 'payments', 'classes', 'search', 'classFilter', 'statusFilter'));
    }

    /**
     * Pay SPP.
     */
    public function paySPP(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:spp_payments,id',
        ]);

        $payment = SppPayment::findOrFail($request->payment_id);
        $payment->update([
            'status' => 'Lunas',
            'payment_date' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Pembayaran SPP berhasil dicatat.');
    }
}
