@extends('layout.student.sidebar')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="mb-6">
        <h2 class="text-2xl font-black text-slate-800 leading-tight">Detail Kehadiran</h2>
        <p class="text-slate-500 text-sm mt-1">Pantau performa absensi dan kehadiran belajar Anda.</p>
    </div>

    <!-- Attendance Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Persentase</p>
            <h3 class="text-3xl font-black text-blue-600">{{ $attendanceRate }}%</h3>
            <span class="text-xs font-semibold text-slate-400 mt-2 block">Kehadiran Kelas</span>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Hadir</p>
            <h3 class="text-3xl font-black text-emerald-500">{{ $presentCount }}</h3>
            <span class="text-xs font-semibold text-slate-400 mt-2 block">Hari Masuk</span>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Izin</p>
            <h3 class="text-3xl font-black text-amber-500">{{ $izinCount }}</h3>
            <span class="text-xs font-semibold text-slate-400 mt-2 block">Hari Mengajukan Izin</span>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Sakit</p>
            <h3 class="text-3xl font-black text-purple-500">{{ $sakitCount }}</h3>
            <span class="text-xs font-semibold text-slate-400 mt-2 block">Hari Istirahat Sakit</span>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Alpa</p>
            <h3 class="text-3xl font-black text-rose-500">{{ $alpaCount }}</h3>
            <span class="text-xs font-semibold text-rose-400 mt-2 block">Ketidakhadiran</span>
        </div>
    </div>

    <!-- Attendance Details Table -->
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-white">
            <h3 class="font-bold text-slate-800 text-[15px]">Riwayat Absensi Harian</h3>
            <span class="text-xs text-slate-400 font-semibold">Total Log: {{ $totalAtt }} Catatan</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="py-4 px-6 font-bold text-slate-400 text-xs uppercase tracking-wider">Tanggal</th>
                        <th class="py-4 px-6 font-bold text-slate-400 text-xs uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="py-4 px-6 font-bold text-slate-400 text-xs uppercase tracking-wider">Guru</th>
                        <th class="py-4 px-6 font-bold text-slate-400 text-xs uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 divide-y divide-slate-50">
                    @forelse($attendances as $att)
                        <tr class="hover:bg-slate-50/40 transition-colors">
                            <td class="py-4 px-6 font-medium text-slate-800">
                                {{ \Carbon\Carbon::parse($att->date)->translatedFormat('d F Y') }}
                            </td>
                            <td class="py-4 px-6 font-bold text-slate-700">{{ $att->schedule->subject ?? '-' }}</td>
                            <td class="py-4 px-6 text-slate-500">{{ $att->schedule->teacher->name ?? '-' }}</td>
                            <td class="py-4 px-6">
                                @if($att->status === 'Hadir')
                                    <span class="bg-emerald-50 text-emerald-500 border border-emerald-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Hadir</span>
                                @elseif($att->status === 'Izin')
                                    <span class="bg-amber-50 text-amber-500 border border-amber-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Izin</span>
                                @elseif($att->status === 'Sakit')
                                    <span class="bg-purple-50 text-purple-500 border border-purple-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Sakit</span>
                                @else
                                    <span class="bg-rose-50 text-rose-500 border border-rose-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Alpa</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-slate-400">Belum ada riwayat kehadiran tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-100">
            {{ $attendances->links() }}
        </div>
    </div>
</div>
@endsection
