<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\Grade;
use Database\Seeders\UserSeeder;
use Database\Seeders\SchoolDataSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class SchoolTransactionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed initial database
        $this->seed(UserSeeder::class);
        $this->seed(SchoolDataSeeder::class);
    }

    /**
     * Test that teacher can view and submit class attendance.
     */
    public function test_teacher_can_submit_attendance(): void
    {
        $teacherUser = User::where('role', 'teacher')->first();
        $teacher = $teacherUser->teacher;
        $schedule = $teacher->schedules()->first();

        // Get students in this class
        $students = Student::where('class', $schedule->class)->get();
        $this->assertNotEmpty($students);

        // Prepare post payload: mark all as Izin (I)
        $statusPayload = [];
        foreach ($students as $student) {
            $statusPayload[$student->id] = 'I';
        }

        // POST attendance submission
        $response = $this->actingAs($teacherUser)->post(route('teacher.absensi.post'), [
            'schedule_id' => $schedule->id,
            'status' => $statusPayload,
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        // Check if logs are written to DB
        $today = Carbon::today()->format('Y-m-d');
        foreach ($students as $student) {
            $this->assertDatabaseHas('attendances', [
                'student_id' => $student->id,
                'schedule_id' => $schedule->id,
                'date' => $today,
                'status' => 'Izin',
            ]);
        }
    }

    /**
     * Test that teacher can submit student grades and student can see them in rapor.
     */
    public function test_teacher_can_submit_grades(): void
    {
        $teacherUser = User::where('role', 'teacher')->first();
        $teacher = $teacherUser->teacher;
        $schedule = $teacher->schedules()->first();

        // Get students in this class
        $students = Student::where('class', $schedule->class)->get();
        $this->assertNotEmpty($students);

        // Prepare post payload: set score of all to 95 for UTS
        $gradesPayload = [];
        foreach ($students as $student) {
            $gradesPayload[$student->id] = [
                'score' => 95,
                'notes' => 'Luar biasa!',
            ];
        }

        // POST grades submission
        $response = $this->actingAs($teacherUser)->post(route('teacher.nilai.post'), [
            'class' => $schedule->class,
            'category' => 'UTS',
            'grades' => $gradesPayload,
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        // Check DB for updated scores
        foreach ($students as $student) {
            $this->assertDatabaseHas('grades', [
                'student_id' => $student->id,
                'subject' => $teacher->mapel,
                'category' => 'UTS',
                'score' => 95,
                'notes' => 'Luar biasa!',
            ]);
        }
    }
}
