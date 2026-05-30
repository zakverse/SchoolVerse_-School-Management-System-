@extends('layout.student.sidebar')

@section('content')
<div class="animate-in fade-in duration-300">
    <div class="mb-8">
        <h2 class="text-2xl font-extrabold text-gray-900">Halo, {{ Auth::user()->student->name ?? Auth::user()->name }}! 👋</h2>
        <p class="text-gray-500 text-sm mt-1">Selamat datang kembali di portal siswa. Pantau perkembangan belajarmu hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="p-4 bg-emerald-50 text-emerald-600 rounded-xl font-black text-xl">{{ $attendanceRate }}%</div>
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Kehadiran</h4>
                <p class="text-sm font-bold text-gray-700 mt-0.5">{{ $attendanceStatus }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="p-4 bg-indigo-50 text-indigo-600 rounded-xl font-black text-xl">{{ $averageGrade }}</div>
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Rata-rata Nilai</h4>
                <p class="text-sm font-bold text-gray-700 mt-0.5">{{ $gradeStatus }}</p>
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
            @forelse($todaySchedules as $index => $sch)
                <div class="p-4 bg-slate-50 rounded-xl flex justify-between items-center border border-slate-100">
                    <div class="flex items-center gap-4">
                        <span class="w-2.5 h-2.5 rounded-full {{ $index === 0 ? 'bg-indigo-600' : 'bg-emerald-600' }}"></span>
                        <div>
                            <h5 class="text-sm font-bold text-gray-800">{{ $sch->subject }}</h5>
                            <p class="text-xs text-gray-400 mt-0.5">Guru: {{ $sch->teacher->name }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-bold {{ $index === 0 ? 'text-indigo-600 bg-indigo-50' : 'text-emerald-600 bg-emerald-50' }} px-3 py-1 rounded-lg">
                            {{ \Carbon\Carbon::parse($sch->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($sch->end_time)->format('H:i') }}
                        </span>
                        <p class="text-[11px] text-gray-400 font-medium mt-1">Ruang {{ $sch->room }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-sm text-center py-6">Tidak ada mata pelajaran hari ini.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection