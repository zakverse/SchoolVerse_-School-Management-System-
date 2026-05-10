<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Sistem Manajemen Sekolah Modern</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans">
    <nav class="flex items-center justify-between px-12 py-6 bg-white border-b border-gray-50 sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="bg-blue-600 p-1.5 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg>
            </div>
            <span class="text-xl font-bold tracking-tight text-gray-900">EduManage</span>
        </div>
        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-500">
            <a href="#" class="hover:text-blue-600 transition-colors">Fitur</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Tentang Kami</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Kontak</a>
        </div>
        <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full text-sm font-bold transition-all shadow-lg shadow-blue-100">
            Masuk Sistem
        </a>
    </nav>

    <section class="px-12 py-20 flex flex-col md:flex-row items-center gap-16">
        <div class="flex-1">
            <span class="text-blue-600 font-bold text-sm uppercase tracking-widest mb-4 block">Smart School Solution</span>
            <h1 class="text-5xl md:text-6xl font-black text-gray-900 leading-tight mb-6">
                Kelola Sekolah Jadi <br><span class="text-blue-600">Lebih Mudah.</span>
            </h1>
            <p class="text-gray-500 text-lg mb-10 max-w-lg leading-relaxed">
                Platform terintegrasi untuk manajemen data siswa, guru, jadwal pelajaran, hingga keuangan sekolah dalam satu dasbor yang modern.
            </p>
            <div class="flex items-center gap-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-xl shadow-blue-100">
                    Mulai Sekarang
                </button>
                <button class="flex items-center gap-2 font-bold text-gray-700 hover:text-blue-600 px-6 py-4 transition-all">
                    <div class="w-10 h-10 rounded-full border-2 border-gray-100 flex items-center justify-center">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6z"/></svg>
                    </div>
                    Lihat Demo
                </button>
            </div>
        </div>
        <div class="flex-1 relative">
            <div class="absolute -top-10 -right-10 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-60"></div>
            <div class="bg-white p-4 rounded-3xl shadow-2xl border border-gray-100 relative z-10">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=800" alt="Dashboard Preview" class="rounded-2xl shadow-inner">
            </div>
        </div>
    </section>

    <footer class="mt-20 border-t border-gray-100 py-12 text-center">
        <p class="text-gray-400 text-sm font-medium">© 2026 EduManage Team. Build with ❤️ for Better Education.</p>
    </footer>
</body>
</html>