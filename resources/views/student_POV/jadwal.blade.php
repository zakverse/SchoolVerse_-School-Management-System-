@extends('layout.student.sidebar')

@section('content')
<div class="animate-in fade-in duration-300">
    <div class="mb-6">
        <h2 class="text-2xl font-extrabold text-gray-900">Jadwal Pelajaran</h2>
        <p class="text-gray-500 text-sm mt-1">Daftar mata pelajaran yang kamu ikuti di Semester Ganjil.</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="grid grid-cols-6 gap-4">
            <div class="bg-gray-50 rounded-xl py-3 flex items-center justify-center text-gray-400 font-bold uppercase text-[11px]">Waktu</div>
            <div class="bg-indigo-950 text-white rounded-xl py-3 text-center font-bold text-sm flex items-center justify-center">Senin</div>
            <div class="bg-indigo-950 text-white rounded-xl py-3 text-center font-bold text-sm flex items-center justify-center">Selasa</div>
            <div class="bg-indigo-950 text-white rounded-xl py-3 text-center font-bold text-sm flex items-center justify-center">Rabu</div>
            <div class="bg-indigo-950 text-white rounded-xl py-3 text-center font-bold text-sm flex items-center justify-center">Kamis</div>
            <div class="bg-indigo-950 text-white rounded-xl py-3 text-center font-bold text-sm flex items-center justify-center">Jumat</div>

            <!-- Baris 1: 07:30 - 09:30 -->
            <div class="flex items-center justify-center text-xs font-bold text-gray-400">07:30 - 09:30</div>
            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                @if($sch = $schedules->first(fn($s) => $s->day === $day && $s->start_time === '07:30:00'))
                    <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-3">
                        <p class="text-indigo-600 font-bold text-xs mb-0.5">{{ $sch->subject }}</p>
                        <p class="text-[10px] text-indigo-400 font-medium">{{ $sch->room }}</p>
                    </div>
                @else
                    <div class="border border-dashed border-gray-100 rounded-xl flex items-center justify-center text-gray-200 font-bold text-[10px]">Kosong</div>
                @endif
            @endforeach

            <!-- Baris 2: 10:00 - 12:00 -->
            <div class="flex items-center justify-center text-xs font-bold text-gray-400">10:00 - 12:00</div>
            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                @if($sch = $schedules->first(fn($s) => $s->day === $day && $s->start_time === '10:00:00'))
                    <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-3">
                        <p class="text-emerald-600 font-bold text-xs mb-0.5">{{ $sch->subject }}</p>
                        <p class="text-[10px] text-emerald-400 font-medium">{{ $sch->room }}</p>
                    </div>
                @else
                    <div class="border border-dashed border-gray-100 rounded-xl flex items-center justify-center text-gray-200 font-bold text-[10px]">Kosong</div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection