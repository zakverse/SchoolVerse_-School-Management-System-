@extends('layout.student.sidebar')

@section('content')
<div class="animate-in fade-in duration-300">
    <div class="mb-8">
        <h2 class="text-2xl font-extrabold text-gray-900">Halo, Dzaki Khothir! 👋</h2>
        <p class="text-gray-500 text-sm mt-1">Selamat datang kembali di portal siswa. Pantau perkembangan belajarmu hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="p-4 bg-emerald-50 text-emerald-600 rounded-xl font-black text-xl">98%</div>
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Kehadiran</h4>
                <p class="text-sm font-bold text-gray-700 mt-0.5">Sangat Baik (Aman)</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="p-4 bg-indigo-50 text-indigo-600 rounded-xl font-black text-xl">88.5</div>
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Rata-rata Nilai</h4>
                <p class="text-sm font-bold text-gray-700 mt-0.5">Di atas rata-rata kelas</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="p-4 bg-amber-50 text-amber-600 rounded-xl font-black text-xl">0</div>
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Tugas Menunggak</h4>
                <p class="text-sm font-bold text-gray-700 mt-0.5">Semua tugas tuntas</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="text-base font-extrabold text-gray-800 mb-4">Mata Pelajaran Hari Ini</h3>
        <div class="space-y-3">
            <div class="p-4 bg-slate-50 rounded-xl flex justify-between items-center border border-slate-100">
                <div class="flex items-center gap-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>
                    <div>
                        <h5 class="text-sm font-bold text-gray-800">Matematika Wajib</h5>
                        <p class="text-xs text-gray-400 mt-0.5">Guru: Pak Budi Santoso</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-lg">07:45 - 09:15</span>
                    <p class="text-[11px] text-gray-400 font-medium mt-1">Ruang R.101</p>
                </div>
            </div>

            <div class="p-4 bg-slate-50 rounded-xl flex justify-between items-center border border-slate-100">
                <div class="flex items-center gap-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                    <div>
                        <h5 class="text-sm font-bold text-gray-800">Bahasa Indonesia</h5>
                        <p class="text-xs text-gray-400 mt-0.5">Guru: Bu Siti Aminah</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg">09:45 - 11:15</span>
                    <p class="text-[11px] text-gray-400 font-medium mt-1">Ruang R.104</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection