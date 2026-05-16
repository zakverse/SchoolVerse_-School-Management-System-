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

            <div class="flex items-center justify-center text-xs font-bold text-gray-400">07:45 - 09:15</div>
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-3">
                <p class="text-indigo-600 font-bold text-xs mb-0.5">Matematika</p>
                <p class="text-[10px] text-indigo-400 font-medium">R.101</p>
            </div>
            <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-3">
                <p class="text-emerald-600 font-bold text-xs mb-0.5">Biologi</p>
                <p class="text-[10px] text-emerald-400 font-medium">Lab Bio</p>
            </div>
            <div class="bg-amber-50 border border-amber-100 rounded-xl p-3">
                <p class="text-amber-600 font-bold text-xs mb-0.5">Kimia</p>
                <p class="text-[10px] text-amber-400 font-medium">R.202</p>
            </div>
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-3">
                <p class="text-indigo-600 font-bold text-xs mb-0.5">Matematika</p>
                <p class="text-[10px] text-indigo-400 font-medium">R.102</p>
            </div>
            <div class="bg-rose-50 border border-rose-100 rounded-xl p-3">
                <p class="text-rose-600 font-bold text-xs mb-0.5">Fisika</p>
                <p class="text-[10px] text-rose-400 font-medium">R.301</p>
            </div>
        </div>
    </div>
</div>
@endsection