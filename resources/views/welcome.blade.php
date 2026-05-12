<!DOCTYPE html>
<html lang="id" class="scroll-smooth"> <!-- Tambahkan scroll-smooth di sini -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Sistem Manajemen Sekolah Modern</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans">
    
    <!-- Navbar -->
    <nav class="flex items-center justify-between px-12 py-6 bg-white/80 backdrop-blur-md border-b border-gray-50 sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="bg-blue-600 p-1.5 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg>
            </div>
            <span class="text-xl font-bold tracking-tight text-gray-900">EduManage</span>
        </div>
        
        <!-- Menu Navigasi dengan ID Tujuan -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-500">
            <a href="#fitur" class="hover:text-blue-600 transition-colors">Fitur</a>
            <a href="#tentang" class="hover:text-blue-600 transition-colors">Tentang Kami</a>
            <a href="#kontak" class="hover:text-blue-600 transition-colors">Kontak</a>
        </div>

        <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full text-sm font-bold transition-all shadow-lg shadow-blue-100">
            Masuk Sistem
        </a>
    </nav>

    <!-- Hero Section -->
    <section class="px-12 py-20 flex flex-col md:flex-row items-center gap-16 min-h-[90vh]">
        <div class="flex-1 animate-in fade-in slide-in-from-left duration-700">
            <span class="text-blue-600 font-bold text-sm uppercase tracking-widest mb-4 block">Smart School Solution</span>
            <h1 class="text-5xl md:text-6xl font-black text-gray-900 leading-tight mb-6">
                Kelola Sekolah Jadi <br><span class="text-blue-600">Lebih Mudah.</span>
            </h1>
            <p class="text-gray-500 text-lg mb-10 max-w-lg leading-relaxed">
                Platform terintegrasi untuk manajemen data siswa, guru, jadwal pelajaran, hingga keuangan sekolah dalam satu dasbor yang modern.
            </p>
            <div class="flex items-center gap-4">
                <a href="#fitur" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-xl shadow-blue-100">
                    Mulai Sekarang
                </a>
                <button class="flex items-center gap-2 font-bold text-gray-700 hover:text-blue-600 px-6 py-4 transition-all">
                    <div class="w-10 h-10 rounded-full border-2 border-gray-100 flex items-center justify-center">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6z"/></svg>
                    </div>
                    Lihat Demo
                </button>
            </div>
        </div>
        <div class="flex-1 relative animate-in fade-in zoom-in duration-1000">
            <div class="absolute -top-10 -right-10 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-60"></div>
            <div class="bg-white p-4 rounded-3xl shadow-2xl border border-gray-100 relative z-10">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=800" alt="Dashboard Preview" class="rounded-2xl shadow-inner">
            </div>
        </div>
    </section>

    <!-- Seksi Fitur -->
    <section id="fitur" class="px-12 py-32 bg-slate-50">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900">Fitur Unggulan</h2>
            <p class="text-gray-500 mt-4">Solusi lengkap untuk kebutuhan administrasi sekolah digital.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Manajemen Siswa</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Kelola data induk siswa, mutasi, hingga absensi secara otomatis dan terpusat.</p>
            </div>
            <!-- Duplikasi untuk fitur lain -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Jadwal Otomatis</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Penyusunan jadwal pelajaran bebas bentrok dengan algoritma cerdas EduManage.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Keuangan SPP</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Pantau arus kas, tunggakan, dan laporan pembayaran SPP secara real-time.</p>
            </div>
        </div>
    </section>

    <!-- Seksi Tentang -->
    <section id="tentang" class="px-12 py-32">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="flex-1">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=800" class="rounded-3xl shadow-xl" alt="Team Work">
            </div>
            <div class="flex-1">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Misi Kami Digitalisasi Pendidikan Indonesia</h2>
                <p class="text-gray-500 leading-relaxed mb-6">
                    EduManage hadir untuk menghilangkan hambatan administratif di sekolah. Kami percaya bahwa dengan sistem yang efisien, guru dapat lebih fokus mendidik dan siswa dapat lebih fokus belajar.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">✓</div>
                        <span class="font-semibold">Terpercaya oleh 100+ Sekolah</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">✓</div>
                        <span class="font-semibold">Keamanan Data Standar Industri</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seksi Kontak -->
    <section id="kontak" class="px-12 py-32 bg-[#1e2f4c] text-white rounded-[3rem] mx-6 mb-20 shadow-2xl">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-6">Siap Bertransformasi?</h2>
            <p class="text-gray-400 mb-10 text-lg">Hubungi tim kami untuk konsultasi gratis atau demo sistem EduManage di sekolah Anda.</p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="https://wa.me/62812345678" class="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-2xl font-bold transition-all">Hubungi WhatsApp</a>
                <a href="mailto:info@edumanage.com" class="bg-white/10 hover:bg-white/20 px-8 py-4 rounded-2xl font-bold transition-all border border-white/20">Email Kami</a>
            </div>
        </div>
    </section>

    <footer class="border-t border-gray-100 py-12 text-center bg-white">
        <p class="text-gray-400 text-sm font-medium">© 2026 EduManage Team. Build with ❤️ for Better Education.</p>
    </footer>

</body>
</html>