@extends('layout.admin.sidebar')

@section('content')
<div class="min-h-screen bg-[#f4f7fb]">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Jadwal Pelajaran</h2>
            <p class="text-gray-500 text-sm mt-1">Jadwal mingguan kelas X MIPA 1 Semester Ganjil.</p>
        </div>
        <div class="flex gap-3">
            <button class="border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 hover:bg-white transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Filter Kelas
            </button>
            <button class="bg-[#2563eb] hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 transition-all shadow-lg shadow-blue-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Jadwal
            </button>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
        <div class="flex justify-between items-center mb-8 border-b border-gray-50 pb-6">
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-500">Pilih Kelas:</span>
                <select class="border border-gray-200 rounded-xl px-4 py-2 text-sm font-bold bg-white outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    <option>X MIPA 1</option>
                    <option>X MIPA 2</option>
                    <option>XI IPS 1</option>
                </select>
            </div>
            <div class="flex gap-4 text-[11px] font-bold uppercase tracking-wider">
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-blue-400"></span> Matematika</div>
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-purple-400"></span> Fisika</div>
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-emerald-400"></span> B. Inggris</div>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-4">
            <div class="bg-gray-50/50 rounded-xl py-3 flex items-center justify-center gap-2 text-gray-400 font-bold uppercase text-[11px]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Waktu
            </div>
            <div class="bg-[#1e2f4c] text-white rounded-xl py-3 text-center font-bold text-sm">Senin</div>
            <div class="bg-[#1e2f4c] text-white rounded-xl py-3 text-center font-bold text-sm">Selasa</div>
            <div class="bg-[#1e2f4c] text-white rounded-xl py-3 text-center font-bold text-sm">Rabu</div>
            <div class="bg-[#1e2f4c] text-white rounded-xl py-3 text-center font-bold text-sm">Kamis</div>
            <div class="bg-[#1e2f4c] text-white rounded-xl py-3 text-center font-bold text-sm">Jumat</div>

            <div class="flex items-center justify-center text-[13px] font-bold text-gray-400">07:00 - 07:45</div>
            <div class="bg-slate-100 rounded-xl p-3 border border-gray-200">
                <p class="text-gray-800 font-bold text-sm mb-1">Upacara</p>
                <p class="text-[11px] text-gray-400">-</p>
                <p class="text-[11px] text-gray-400 mt-2 font-medium">Lapangan</p>
            </div>
            <div class="bg-purple-50 rounded-xl p-3 border border-purple-100">
                <p class="text-purple-600 font-bold text-sm mb-1">Fisika</p>
                <p class="text-[11px] text-purple-400">Ahmad Dahlan</p>
                <p class="text-[11px] text-purple-400 mt-2 font-medium">Lab Fisika</p>
            </div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>

            <div class="flex items-center justify-center text-[13px] font-bold text-gray-400">07:45 - 08:30</div>
            <div class="bg-blue-50 rounded-xl p-3 border border-blue-100">
                <p class="text-blue-600 font-bold text-sm mb-1">Matematika</p>
                <p class="text-[11px] text-blue-400">Budi Santoso</p>
                <p class="text-[11px] text-blue-400 mt-2 font-medium">R.101</p>
            </div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>

            <div class="flex items-center justify-center text-[13px] font-bold text-gray-400">08:30 - 09:15</div>
            <div class="bg-orange-50 rounded-xl p-3 border border-orange-100">
                <p class="text-orange-600 font-bold text-sm mb-1">Kimia</p>
                <p class="text-[11px] text-orange-400">Rina S.</p>
                <p class="text-[11px] text-orange-400 mt-2 font-medium">Lab Kimia</p>
            </div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>

            <div class="flex items-center justify-center text-[13px] font-bold text-gray-400 uppercase tracking-tighter">09:15 - 09:45</div>
            <div class="col-span-5 bg-yellow-50/50 border border-dashed border-yellow-200 rounded-xl flex items-center justify-center py-2">
                <span class="text-yellow-600 font-black uppercase text-[11px] tracking-[0.3em]">Waktu Istirahat</span>
            </div>

            <div class="flex items-center justify-center text-[13px] font-bold text-gray-400">09:45 - 10:30</div>
            <div class="bg-emerald-50 rounded-xl p-3 border border-emerald-100">
                <p class="text-emerald-600 font-bold text-sm mb-1">Bahasa Inggris</p>
                <p class="text-[11px] text-emerald-400">Siti Aminah</p>
                <p class="text-[11px] text-emerald-400 mt-2 font-medium">R.101</p>
            </div>
            <div class="bg-red-50 rounded-xl p-3 border border-red-100">
                <p class="text-red-600 font-bold text-sm mb-1">Sejarah</p>
                <p class="text-[11px] text-red-400">Rina Wijaya</p>
                <p class="text-[11px] text-red-400 mt-2 font-medium">R.101</p>
            </div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
            <div class="border border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
        </div>
    </div>
</div>
@endsection