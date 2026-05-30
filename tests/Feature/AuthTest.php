<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Database\Seeders\SchoolDataSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed the database for testing
        $this->seed(UserSeeder::class);
        $this->seed(SchoolDataSeeder::class);
    }

    /**
     * Test guest redirects.
     */
    public function test_guests_are_redirected_to_login(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
        $this->get(route('teacher.dashboard'))->assertRedirect(route('login'));
        $this->get(route('student.dashboard'))->assertRedirect(route('login'));
    }

    /**
     * Test admin authentication and access control.
     */
    public function test_admin_can_login_and_access_only_admin_portal(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Login Admin
        $response = $this->post(route('login.post'), [
            'email' => $admin->email,
            'password' => '12345678',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);

        // Access Admin Dashboard
        $this->actingAs($admin)->get(route('admin.dashboard'))->assertStatus(200);

        // Access Forbidden Portals
        $this->actingAs($admin)->get(route('teacher.dashboard'))->assertStatus(403);
        $this->actingAs($admin)->get(route('student.dashboard'))->assertStatus(403);
    }

    /**
     * Test teacher authentication and access control.
     */
    public function test_teacher_can_login_and_access_only_teacher_portal(): void
    {
        $teacher = User::where('role', 'teacher')->first();

        // Login Teacher
        $response = $this->post(route('login.post'), [
            'email' => $teacher->email,
            'password' => '12345678',
        ]);

        $response->assertRedirect(route('teacher.dashboard'));
        $this->assertAuthenticatedAs($teacher);

        // Access Teacher Dashboard
        $this->actingAs($teacher)->get(route('teacher.dashboard'))->assertStatus(200);

        // Access Forbidden Portals
        $this->actingAs($teacher)->get(route('admin.dashboard'))->assertStatus(403);
        $this->actingAs($teacher)->get(route('student.dashboard'))->assertStatus(403);
    }

    /**
     * Test student authentication and access control.
     */
    public function test_student_can_login_and_access_only_student_portal(): void
    {
        $student = User::where('role', 'student')->first();

        // Login Student
        $response = $this->post(route('login.post'), [
            'email' => $student->email,
            'password' => '12345678',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticatedAs($student);

        // Access Student Dashboard
        $this->actingAs($student)->get(route('student.dashboard'))->assertStatus(200);

        // Access Forbidden Portals
        $this->actingAs($student)->get(route('admin.dashboard'))->assertStatus(403);
        $this->actingAs($student)->get(route('teacher.dashboard'))->assertStatus(403);
    }

    /**
     * Test logout.
     */
    public function test_user_can_logout(): void
    {
        $user = User::first();
        $this->actingAs($user);

        $response = $this->post(route('logout'));
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
