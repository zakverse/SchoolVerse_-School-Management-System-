<?php

namespace Database\Seeders;

use App\Models\User;
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

        foreach ($namaGuru as $index => $nama) {
            User::create([
                'name' => 'Pak/Bu ' . $nama,
                'email' => 'teacher' . ($index + 1) . '@edumanage.com',
                'password' => Hash::make('12345678'),
                'role' => 'teacher',
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

        foreach ($namaMuridAnime as $index => $nama) {
            User::create([
                'name' => $nama,
                'email' => 'student' . ($index + 1) . '@edumanage.com',
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ]);
        }
    }
}