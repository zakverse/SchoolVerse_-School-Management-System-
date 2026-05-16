# 🎓 EduManage - Modern School Management System

EduManage adalah platform manajemen sekolah modern yang dirancang untuk mengintegrasikan data administratif, jadwal, presensi, hingga penilaian akademis dalam satu dasbor yang dinamis dan *UX-centric*.

---

## 🗺️ Multi-POV Architecture

Aplikasi ini memisahkan hak akses dan fungsionalitas berdasarkan 3 peran utama di sekolah:

### 1. 💼 Admin Portal
* **Data Induk:** Pengelolaan data utama siswa dan guru secara terpusat.
* **Manajemen Jadwal:** Pengaturan waktu dan ruang kelas.
* **Keuangan:** Pemantauan arus kas dan rekapitulasi pembayaran SPP.

### 2. 👨‍🏫 Teacher Portal
* **Presensi Kelas:** Pengisian kehadiran siswa secara *real-time* per jam pelajaran dengan *segmented interface* yang interaktif.
* **Input Nilai Fleksibel:** Pengelolaan nilai berkala (Tugas, UTS, UAS) dilengkapi fitur kustomisasi kategori nilai mandiri (Praktikum/Proyek) melalui sistem Modal.

### 3. 🎒 Student Portal
* **Dasbor Personal:** Menampilkan persentase kehadiran dan ringkasan performa belajar.
* **Digital Timetable:** Akses langsung ke jadwal pelajaran mingguan yang terstruktur.
* **Transkrip Nilai:** Transparansi perolehan nilai tugas dan rapor semester aktif.

---

## 🛠️ Tech Stack & Environment

* **Framework:** Laravel 11 (PHP 8.2+)
* **Frontend:** Tailwind CSS & Laravel Blade
* **Server Environment:** Laravel Herd & MySQL
* **Interaktivitas:** Vanilla JavaScript / Alpine.js

---

## 📈 Status Pengembangan Proyek

- [x] UI Landing Page dengan fitur *Smooth Scroll*
- [x] UI Portal Admin (Dashboard & Login Page)
- [x] UI Portal Guru (Dashboard, Jadwal, Absensi, & Input Nilai)
- [x] UI Portal Murid dengan tema *Slate-Gray Minimalist*
- [ ] Setup Database Migration & Relasi Tabel (Admin, Guru, Siswa, Nilai, Jadwal)
- [ ] Implementasi Multi-Auth Login berdasarkan POV User
- [ ] Logic CRUD Data Siswa & Guru
- [ ] Fitur Cetak Rapor PDF & Ekspor-Impor Excel