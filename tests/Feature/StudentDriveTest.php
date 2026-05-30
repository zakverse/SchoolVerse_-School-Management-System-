<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Student;
use App\Models\StudentFile;
use Database\Seeders\UserSeeder;
use Database\Seeders\SchoolDataSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentDriveTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->seed(SchoolDataSeeder::class);
    }

    /**
     * Test student can view their photo vault.
     */
    public function test_student_can_view_drive(): void
    {
        $studentUser = User::where('role', 'student')->first();

        $response = $this->actingAs($studentUser)->get(route('student.drive'));
        $response->assertStatus(200);
    }

    /**
     * Test student can upload a photo and delete it.
     */
    public function test_student_can_upload_and_delete_photo(): void
    {
        Storage::fake('public');

        $studentUser = User::where('role', 'student')->first();
        $student = $studentUser->student;

        // 1. Upload a fake photo
        $file = UploadedFile::fake()->image('assignment.jpg');

        $response = $this->actingAs($studentUser)->post(route('student.drive.post'), [
            'photo' => $file
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');

        // Check it exists in DB
        $this->assertDatabaseHas('student_files', [
            'student_id' => $student->id,
            'title' => 'assignment.jpg',
        ]);

        $studentFile = StudentFile::where('title', 'assignment.jpg')->first();
        $this->assertNotNull($studentFile);

        // Check file exists in fake storage
        Storage::disk('public')->assertExists($studentFile->file_path);

        // 2. Delete the photo
        $response = $this->actingAs($studentUser)->delete(route('student.drive.delete', $studentFile->id));

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');

        // Verify missing in DB and Storage
        $this->assertDatabaseMissing('student_files', [
            'id' => $studentFile->id
        ]);
        Storage::disk('public')->assertMissing($studentFile->file_path);
    }
}
