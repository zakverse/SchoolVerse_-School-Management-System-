<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Student;
use App\Models\SppPayment;
use Database\Seeders\UserSeeder;
use Database\Seeders\SchoolDataSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class StudentPortalExtensionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed database
        $this->seed(UserSeeder::class);
        $this->seed(SchoolDataSeeder::class);
    }

    /**
     * Test student can access new navigation links.
     */
    public function test_student_can_access_new_routes(): void
    {
        $studentUser = User::where('role', 'student')->first();

        $routes = [
            'student.absensi',
            'student.spp',
            'student.profile'
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($studentUser)->get(route($route));
            $response->assertStatus(200);
        }
    }

    /**
     * Test student can update password with proper validations.
     */
    public function test_student_can_change_password(): void
    {
        $studentUser = User::where('role', 'student')->first();

        // 1. Change password with wrong old password (should fail)
        $response = $this->actingAs($studentUser)->post(route('student.profile.password'), [
            'old_password' => 'wrong_password',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['old_password']);
        $this->assertTrue(Hash::check('12345678', $studentUser->fresh()->password));

        // 2. Change password with matching old password (should succeed)
        $response = $this->actingAs($studentUser)->post(route('student.profile.password'), [
            'old_password' => '12345678',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');

        // Verify password is updated in DB
        $this->assertTrue(Hash::check('newpassword123', $studentUser->fresh()->password));
    }
}
