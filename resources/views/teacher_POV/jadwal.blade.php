@extends('layout.teacher.sidebar')

@section('content')
<div class="animate-in fade-in duration-300">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900">Jadwal Mengajar</h2>
            <p class="text-gray-500 text-sm mt-1">Daftar jam mengajar Anda pada Semester Ganjil ini.</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-all shadow-lg shadow-blue-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Jadwal Saya
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex justify-between items-center mb-8 border-b border-gray-50 pb-6">
            <div class="text-sm font-semibold text-gray-700">
                Total Beban Mengajar: <span class="text-blue-600 font-bold">{{ $totalJam }} Jam / Minggu</span>
            </div>
            <div class="flex gap-4 text-[11px] font-bold uppercase tracking-wider">
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-blue-500"></span> Matematika Wajib</div>
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-indigo-500"></span> Matematika Peminatan</div>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-4">
            <div class="bg-gray-50 rounded-xl py-3 flex items-center justify-center gap-2 text-gray-400 font-bold uppercase text-[11px]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Waktu
            </div>
            <div class="bg-[#1e2f4c] text-white rounded-xl py-3 text-center font-bold text-sm flex items-center justify-center">Senin</div>
            <div class="bg-[#1e2f4c] text-white rounded-xl py-3 text-center font-bold text-sm flex items-center justify-center">Selasa</div>
            <div class="bg-[#1e2f4c] text-white rounded-xl py-3 text-center font-bold text-sm flex items-center justify-center">Rabu</div>
            <div class="bg-[#1e2f4c] text-white rounded-xl py-3 text-center font-bold text-sm flex items-center justify-center">Kamis</div>
            <div class="bg-[#1e2f4c] text-white rounded-xl py-3 text-center font-bold text-sm flex items-center justify-center">Jumat</div>

            <div class="flex items-center justify-center text-[13px] font-bold text-gray-400">07:00 - 07:45</div>
            <div class="bg-slate-50/60 border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-400 text-xs font-semibold p-4">
                Koordinasi Guru
            </div>
            <div class="border border-dashed border-gray-100 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4">
                <p class="text-indigo-600 font-bold text-sm mb-1">Matematika Pem.</p>
                <p class="text-[11px] text-indigo-400 font-medium">Kelas XI MIPA 3</p>
                <p class="text-[11px] text-indigo-400 mt-2 font-medium">Ruang R.204</p>
            </div>
            <div class="border border-dashed border-gray-100 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-100 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>

            <div class="flex items-center justify-center text-[13px] font-bold text-gray-400">07:45 - 09:15</div>
            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                @if($sch = $schedules->first(fn($s) => $s->day === $day && $s->start_time === '07:30:00'))
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                        <p class="text-blue-600 font-bold text-sm mb-1">{{ $sch->subject }}</p>
                        <p class="text-[11px] text-blue-400 font-medium">Kelas {{ $sch->class }}</p>
                        <p class="text-[11px] text-blue-400 mt-2 font-medium">Ruang {{ $sch->room }}</p>
                    </div>
                @else
                    <div class="border border-dashed border-gray-100 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
                @endif
            @endforeach

            <div class="flex items-center justify-center text-[13px] font-bold text-gray-400 uppercase tracking-tighter">09:15 - 09:45</div>
            <div class="col-span-5 bg-amber-50/50 border border-dashed border-amber-200 rounded-xl flex items-center justify-center py-2.5">
                <span class="text-amber-600 font-black uppercase text-[11px] tracking-[0.3em]">Waktu Istirahat</span>
            </div>

            <div class="flex items-center justify-center text-[13px] font-bold text-gray-400">09:45 - 11:15</div>
            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                @if($sch = $schedules->first(fn($s) => $s->day === $day && $s->start_time === '10:00:00'))
                    <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4">
                        <p class="text-indigo-600 font-bold text-sm mb-1">{{ $sch->subject }}</p>
                        <p class="text-[11px] text-indigo-400 font-medium">Kelas {{ $sch->class }}</p>
                        <p class="text-[11px] text-indigo-400 mt-2 font-medium">Ruang {{ $sch->room }}</p>
                    </div>
                @else
                    <div class="border border-dashed border-gray-100 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection