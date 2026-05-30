<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ==========================================
        // AKUN ADMIN (1 AKUN)
        // ==========================================
        User::create([
            'name' => 'Super Admin EduManage',
            'email' => 'admin@edumanage.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // ==========================================
        // AKUN GURU
        // ==========================================
        $namaGuru = [
            'Budi Santoso', 
            'Siti Aminah', 
            'Ahmad Yani', 
            'Dewi Lestari', 
            'Rizky Pratama'
        ];

        $mapelGuru = [
            'Matematika',
            'Bahasa Inggris',
            'Fisika',
            'Kimia',
            'Biologi'
        ];

        $jabatanGuru = [
            'Wali Kelas X MIPA 1',
            'Wali Kelas X MIPA 2',
            'Kepala Laboratorium',
            'Guru BK',
            'Wali Kelas XI IPS 1'
        ];

        foreach ($namaGuru as $index => $nama) {
            $user = User::create([
                'name' => 'Pak/Bu ' . $nama,
                'email' => 'teacher' . ($index + 1) . '@edumanage.com',
                'password' => Hash::make('12345678'),
                'role' => 'teacher',
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'nip' => '19820315201012100' . ($index + 1),
                'name' => 'Pak/Bu ' . $nama,
                'mapel' => $mapelGuru[$index],
                'jabatan' => $jabatanGuru[$index],
                'profile_picture' => 'https://i.pravatar.cc/150?img=' . (10 + $index),
                'status' => 'active',
            ]);
        }

        // ==========================================
        // AKUN SISWA
        // ==========================================
        $namaMuridAnime = [
            'Eren Yeager',       // student1@edumanage.com
            'Light Yagami',      // student2@edumanage.com
            'Naruto Uzumaki',    // student3@edumanage.com
            'Sasuke Uchiha',     // student4@edumanage.com
            'Monkey D. Luffy',   // student5@edumanage.com
            'Roronoa Zoro',      // student6@edumanage.com
            'Killua Zoldyck',    // student7@edumanage.com
            'Gojo Satoru',       // student8@edumanage.com
            'Izuku Midoriya',    // student9@edumanage.com
            'L Lawliet'          // student10@edumanage.com
        ];

        $kelasMurid = [
            'X MIPA 1',
            'X MIPA 1',
            'X MIPA 2',
            'X MIPA 2',
            'XI IPS 1',
            'XI IPS 1',
            'X MIPA 1',
            'X MIPA 2',
            'XI IPS 1',
            'X MIPA 1'
        ];

        $genderMurid = [
            'Laki-laki',
            'Laki-laki',
            'Laki-laki',
            'Laki-laki',
            'Laki-laki',
            'Laki-laki',
            'Laki-laki',
            'Laki-laki',
            'Laki-laki',
            'Laki-laki'
        ];

        foreach ($namaMuridAnime as $index => $nama) {
            $user = User::create([
                'name' => $nama,
                'email' => 'student' . ($index + 1) . '@edumanage.com',
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'nis' => '2100' . ($index + 1),
                'name' => $nama,
                'class' => $kelasMurid[$index],
                'gender' => $genderMurid[$index],
                'status' => 'active',
            ]);
        }
    }
}