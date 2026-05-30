<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Teacher Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f4f7fb] text-gray-800 antialiased flex">

    <aside class="w-64 bg-[#1e2f4c] text-white min-h-screen flex flex-col fixed left-0 top-0 z-40 shadow-xl">
        <div class="flex items-center gap-3 px-6 py-6 border-b border-slate-700/50">
            <div class="bg-blue-600 p-1.5 rounded-lg">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg>
            </div>
            <span class="text-lg font-black tracking-tight uppercase">EduManage</span>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5">
            <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Menu Guru</p>

            <a href="{{ route('teacher.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ Request::is('teacher/dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-700/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            <a href="{{ route('teacher.jadwal') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ Request::is('teacher/jadwal') ? 'bg-blue-600 text-white shadow-lg shadow-blue-700/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Jadwal Mengajar
            </a>

            <a href="{{ route('teacher.absensi') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ Request::is('teacher/absensi') ? 'bg-blue-600 text-white shadow-lg shadow-blue-700/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                Presensi Siswa
            </a>

            <a href="{{ route('teacher.nilai') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ Request::is('teacher/nilai') ? 'bg-blue-600 text-white shadow-lg shadow-blue-700/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Input Nilai & Rapor
            </a>
        </nav>

        <div class="p-4 border-t border-slate-700/50 flex items-center justify-between">
            <div class="flex items-center gap-3">
                @if(Auth::user()->teacher && Auth::user()->teacher->profile_picture)
                    <img src="{{ Auth::user()->teacher->profile_picture }}" alt="Profil" class="w-9 h-9 rounded-full object-cover border border-slate-600">
                @else
                    <div class="w-9 h-9 rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30 flex items-center justify-center font-bold text-sm uppercase">
                        {{ strtoupper(substr(Auth::user()->teacher->name ?? Auth::user()->name ?? 'G', 0, 2)) }}
                    </div>
                @endif
                <div>
                    <p class="text-xs font-bold text-white truncate max-w-[120px]">{{ Auth::user()->teacher->name ?? Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-400 font-medium mt-0.5 truncate max-w-[120px]">{{ Auth::user()->teacher->mapel ?? 'Guru' }}</p>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-slate-400 hover:text-red-400 transition-colors p-1.5 rounded-lg hover:bg-white/5" title="Keluar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </a>
        </div>
    </aside>

    <main class="flex-1 min-h-screen pl-64">
        <header class="bg-white border-b border-gray-100 px-8 py-4 flex justify-between items-center sticky top-0 z-30">
            <h1 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Portal Guru</h1>
            <div class="flex items-center gap-4">
                <span class="text-xs font-bold bg-emerald-50 text-emerald-600 px-3 py-1.5 rounded-full border border-emerald-100">Semester Ganjil</span>
            </div>
        </header>

        <div class="p-8">
            @yield('content')
        </div>
    </main>

</body>
</html>