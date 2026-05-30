<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Schedule;
use App\Models\SppPayment;
use Database\Seeders\UserSeeder;
use Database\Seeders\SchoolDataSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPortalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed the database
        $this->seed(UserSeeder::class);
        $this->seed(SchoolDataSeeder::class);
    }

    /**
     * Test admin can access all admin views.
     */
    public function test_admin_can_access_all_admin_views(): void
    {
        $admin = User::where('role', 'admin')->first();

        $routes = [
            'admin.dashboard',
            'admin.datasiswa',
            'admin.dataguru',
            'admin.jadwal',
            'admin.absensi',
            'admin.nilai',
            'admin.keuangan'
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($admin)->get(route($route));
            $response->assertStatus(200);
        }
    }

    /**
     * Test admin can create, update, and delete teacher.
     */
    public function test_admin_teacher_crud(): void
    {
        $admin = User::where('role', 'admin')->first();

        // 1. Create Teacher
        $response = $this->actingAs($admin)->post(route('admin.dataguru.post'), [
            'nip' => '199999999999999999',
            'name' => 'Dr. Robert Downey',
            'mapel' => 'Kimia',
            'jabatan' => 'Guru Mapel',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('users', [
            'name' => 'Dr. Robert Downey',
            'email' => 'teacher.199999999999999999@edumanage.com',
            'role' => 'teacher'
        ]);

        $this->assertDatabaseHas('teachers', [
            'nip' => '199999999999999999',
            'name' => 'Dr. Robert Downey',
            'mapel' => 'Kimia',
            'jabatan' => 'Guru Mapel',
            'status' => 'active'
        ]);

        // 2. Update Teacher
        $teacher = Teacher::where('nip', '199999999999999999')->first();
        $response = $this->actingAs($admin)->put(route('admin.dataguru.put', $teacher->id), [
            'nip' => '199999999999999999',
            'name' => 'Dr. Robert Downey Jr.',
            'mapel' => 'Fisika',
            'jabatan' => 'Wali Kelas',
            'status' => 'inactive',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('teachers', [
            'id' => $teacher->id,
            'name' => 'Dr. Robert Downey Jr.',
            'mapel' => 'Fisika',
            'jabatan' => 'Wali Kelas',
            'status' => 'inactive',
        ]);

        // 3. Delete Teacher
        $response = $this->actingAs($admin)->delete(route('admin.dataguru.delete', $teacher->id));
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('teachers', [
            'id' => $teacher->id
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => 'teacher.199999999999999999@edumanage.com'
        ]);
    }

    /**
     * Test admin can create, update, and delete student.
     */
    public function test_admin_student_crud(): void
    {
        $admin = User::where('role', 'admin')->first();

        // 1. Create Student
        $response = $this->actingAs($admin)->post(route('admin.datasiswa.post'), [
            'nis' => '99999',
            'name' => 'Peter Parker',
            'class' => 'XI IPS 1',
            'gender' => 'Laki-laki',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('users', [
            'name' => 'Peter Parker',
            'email' => 'student.99999@edumanage.com',
            'role' => 'student'
        ]);

        $this->assertDatabaseHas('students', [
            'nis' => '99999',
            'name' => 'Peter Parker',
            'class' => 'XI IPS 1',
            'gender' => 'Laki-laki',
            'status' => 'active'
        ]);

        // 2. Update Student
        $student = Student::where('nis', '99999')->first();
        $response = $this->actingAs($admin)->put(route('admin.datasiswa.put', $student->id), [
            'nis' => '99999',
            'name' => 'Peter Benjamin Parker',
            'class' => 'X MIPA 1',
            'gender' => 'Laki-laki',
            'status' => 'inactive',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Peter Benjamin Parker',
            'class' => 'X MIPA 1',
            'status' => 'inactive',
        ]);

        // 3. Delete Student
        $response = $this->actingAs($admin)->delete(route('admin.datasiswa.delete', $student->id));
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('students', [
            'id' => $student->id
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => 'student.99999@edumanage.com'
        ]);
    }

    /**
     * Test admin can manage schedules.
     */
    public function test_admin_schedule_management(): void
    {
        $admin = User::where('role', 'admin')->first();
        $teacher = Teacher::first();

        // 1. Create Schedule
        $response = $this->actingAs($admin)->post(route('admin.jadwal.post'), [
            'class' => 'X MIPA 1',
            'teacher_id' => $teacher->id,
            'subject' => 'Astronomi',
            'day' => 'Senin',
            'start_time' => '13:00',
            'end_time' => '15:00',
            'room' => 'Lab Astronomi',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('schedules', [
            'class' => 'X MIPA 1',
            'teacher_id' => $teacher->id,
            'subject' => 'Astronomi',
            'day' => 'Senin',
            'room' => 'Lab Astronomi',
        ]);

        // 2. Delete Schedule
        $schedule = Schedule::where('subject', 'Astronomi')->first();
        $response = $this->actingAs($admin)->delete(route('admin.jadwal.delete', $schedule->id));

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('schedules', [
            'id' => $schedule->id
        ]);
    }

    /**
     * Test admin can record SPP Payment.
     */
    public function test_admin_can_record_spp_payment(): void
    {
        $admin = User::where('role', 'admin')->first();
        $unpaidPayment = SppPayment::where('status', 'Belum Lunas')->first();

        $this->assertNotNull($unpaidPayment);

        $response = $this->actingAs($admin)->post(route('admin.keuangan.pay'), [
            'payment_id' => $unpaidPayment->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('spp_payments', [
            'id' => $unpaidPayment->id,
            'status' => 'Lunas',
        ]);
    }
}
