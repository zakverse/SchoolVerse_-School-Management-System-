<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\SppPayment;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SchoolDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::all();
        $students = Student::all();

        if ($teachers->isEmpty() || $students->isEmpty()) {
            return;
        }

        // ==========================================
        // 1. SEED SCHEDULES (JADWAL)
        // ==========================================
        $schedulesData = [
            // Teacher 1: Matematika
            [
                'teacher_index' => 0, // Budi Santoso
                'subject' => 'Matematika',
                'class' => 'X MIPA 1',
                'day' => 'Senin',
                'start_time' => '07:30:00',
                'end_time' => '09:30:00',
                'room' => 'R.101 MIPA 1',
            ],
            [
                'teacher_index' => 0,
                'subject' => 'Matematika',
                'class' => 'X MIPA 2',
                'day' => 'Selasa',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'room' => 'R.102 MIPA 2',
            ],
            // Teacher 2: Bahasa Inggris
            [
                'teacher_index' => 1, // Siti Aminah
                'subject' => 'Bahasa Inggris',
                'class' => 'X MIPA 1',
                'day' => 'Selasa',
                'start_time' => '07:30:00',
                'end_time' => '09:30:00',
                'room' => 'R.101 MIPA 1',
            ],
            [
                'teacher_index' => 1,
                'subject' => 'Bahasa Inggris',
                'class' => 'XI IPS 1',
                'day' => 'Rabu',
                'start_time' => '07:30:00',
                'end_time' => '09:30:00',
                'room' => 'R.201 IPS 1',
            ],
            // Teacher 3: Fisika
            [
                'teacher_index' => 2, // Ahmad Yani
                'subject' => 'Fisika',
                'class' => 'X MIPA 1',
                'day' => 'Rabu',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'room' => 'R.101 MIPA 1',
            ],
            [
                'teacher_index' => 2,
                'subject' => 'Fisika',
                'class' => 'X MIPA 2',
                'day' => 'Kamis',
                'start_time' => '07:30:00',
                'end_time' => '09:30:00',
                'room' => 'R.102 MIPA 2',
            ],
            // Teacher 4: Kimia
            [
                'teacher_index' => 3, // Dewi Lestari
                'subject' => 'Kimia',
                'class' => 'X MIPA 2',
                'day' => 'Senin',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'room' => 'R.102 MIPA 2',
            ],
            [
                'teacher_index' => 3,
                'subject' => 'Kimia',
                'class' => 'XI IPS 1',
                'day' => 'Jumat',
                'start_time' => '07:30:00',
                'end_time' => '09:30:00',
                'room' => 'R.201 IPS 1',
            ],
            // Teacher 5: Biologi
            [
                'teacher_index' => 4, // Rizky Pratama
                'subject' => 'Biologi',
                'class' => 'XI IPS 1',
                'day' => 'Kamis',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'room' => 'R.201 IPS 1',
            ],
            [
                'teacher_index' => 4,
                'subject' => 'Biologi',
                'class' => 'X MIPA 1',
                'day' => 'Jumat',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'room' => 'R.101 MIPA 1',
            ],
        ];

        $schedules = [];
        foreach ($schedulesData as $data) {
            $teacher = $teachers[$data['teacher_index']];
            $schedules[] = Schedule::create([
                'teacher_id' => $teacher->id,
                'subject' => $data['subject'],
                'class' => $data['class'],
                'day' => $data['day'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'room' => $data['room'],
            ]);
        }

        // ==========================================
        // 2. SEED ATTENDANCES (PRESENSI)
        // ==========================================
        // Kita seed presensi untuk 2 minggu ke belakang
        $statuses = ['Hadir', 'Hadir', 'Hadir', 'Hadir', 'Hadir', 'Hadir', 'Sakit', 'Izin', 'Hadir', 'Alpa'];
        $daysMap = [
            'Senin' => Carbon::MONDAY,
            'Selasa' => Carbon::TUESDAY,
            'Rabu' => Carbon::WEDNESDAY,
            'Kamis' => Carbon::THURSDAY,
            'Jumat' => Carbon::FRIDAY,
        ];

        for ($i = 0; $i < 14; $i++) {
            $date = Carbon::now()->subDays($i);
            $dayName = $date->translatedFormat('l'); // Senin, Selasa, dll.
            // fallback bahasa default jika translatedFormat tidak diset ke id
            $engDayName = $date->format('l');
            $indoDayName = match($engDayName) {
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                default => null
            };

            if (!$indoDayName) continue;

            // Cari jadwal pada hari ini
            $daySchedules = array_filter($schedules, function ($sch) use ($indoDayName) {
                return $sch->day === $indoDayName;
            });

            foreach ($daySchedules as $sch) {
                // Cari siswa di kelas ini
                $classStudents = $students->filter(function ($std) use ($sch) {
                    return $std->class === $sch->class;
                });

                foreach ($classStudents as $std) {
                    // Random status
                    $status = $statuses[array_rand($statuses)];
                    Attendance::create([
                        'student_id' => $std->id,
                        'schedule_id' => $sch->id,
                        'date' => $date->format('Y-m-d'),
                        'status' => $status,
                    ]);
                }
            }
        }

        // ==========================================
        // 3. SEED GRADES (NILAI)
        // ==========================================
        $subjects = ['Matematika', 'Bahasa Inggris', 'Fisika', 'Kimia', 'Biologi'];
        $categories = ['Tugas', 'UTS', 'UAS', 'Praktikum', 'Proyek'];

        foreach ($students as $std) {
            foreach ($subjects as $sub) {
                // Untuk setiap siswa dan matapelajaran, buat 2-3 nilai acak
                $numGrades = rand(2, 4);
                $chosenCategories = array_rand(array_flip($categories), $numGrades);
                if (!is_array($chosenCategories)) {
                    $chosenCategories = [$chosenCategories];
                }

                foreach ($chosenCategories as $cat) {
                    Grade::create([
                        'student_id' => $std->id,
                        'subject' => $sub,
                        'category' => $cat,
                        'score' => rand(70, 100),
                        'notes' => rand(0, 1) ? 'Pertahankan prestasimu!' : null,
                    ]);
                }
            }
        }

        // ==========================================
        // 4. SEED SPP PAYMENTS (SPP)
        // ==========================================
        $months = [1, 2, 3, 4, 5]; // Januari - Mei
        $year = 2026;
        $sppAmount = 350000.00;

        foreach ($students as $std) {
            foreach ($months as $m) {
                // Kebanyakan lunas, beberapa siswa belum lunas di bulan-bulan akhir
                $isPaid = true;
                if ($m >= 4 && rand(1, 10) > 8) {
                    $isPaid = false;
                }

                SppPayment::create([
                    'student_id' => $std->id,
                    'month' => $m,
                    'year' => $year,
                    'amount' => $sppAmount,
                    'status' => $isPaid ? 'Lunas' : 'Belum Lunas',
                    'payment_date' => $isPaid ? Carbon::create($year, $m, rand(1, 10), 10, 0, 0) : null,
                ]);
            }
        }
    }
}
