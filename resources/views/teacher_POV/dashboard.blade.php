@extends('layout.teacher.sidebar')

@section('content')
<div class="animate-in fade-in duration-300">
    <div class="mb-8">
        <h2 class="text-2xl font-extrabold text-gray-900">Halo, Pak Budi Santoso 👋</h2>
        <p class="text-gray-500 text-sm mt-1">Berikut adalah ringkasan aktivitas mengajar Anda hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Total Jam Mengajar</p>
            <h3 class="text-3xl font-black text-gray-800">24 Jam <span class="text-sm font-medium text-gray-400">/ minggu</span></h3>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Kelas Diampu</p>
            <h3 class="text-3xl font-black text-gray-800">4 Kelas</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tugas Tambahan</p>
            <h3 class="text-lg font-bold text-blue-600 mt-1.5">Wali Kelas X MIPA 1</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-md font-bold text-gray-900 mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Jadwal Mengajar Hari Ini
            </h3>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-blue-50/50 border border-blue-100/50 rounded-xl">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-600 text-white font-bold text-xs px-3 py-2 rounded-lg">Jam 2-3</div>
                        <div>
                            <p class="font-bold text-gray-800 text-sm">Matematika Wajib</p>
                            <p class="text-xs text-gray-400 mt-0.5">Kelas X MIPA 1 • Ruang R.101</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-blue-600">07:45 - 09:15</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 border border-gray-100 rounded-xl">
                    <div class="flex items-center gap-4">
                        <div class="bg-gray-400 text-white font-bold text-xs px-3 py-2 rounded-lg">Jam 5-6</div>
                        <div>
                            <p class="font-bold text-gray-700 text-sm">Matematika Peminatan</p>
                            <p class="text-xs text-gray-400 mt-0.5">Kelas XI MIPA 3 • Ruang R.204</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-gray-400">10:00 - 11:30</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-md font-bold text-gray-900 mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9"></path></svg>
                Pengumuman Internal
            </h3>
            <div class="space-y-4">
                <div class="pb-4 border-b border-gray-50">
                    <span class="text-[10px] font-bold text-red-500 bg-red-50 px-2 py-0.5 rounded uppercase tracking-wider">Penting</span>
                    <p class="font-bold text-gray-800 text-xs mt-2 hover:underline cursor-pointer">Rapat Pleno Kenaikan Kelas Ganjil</p>
                    <p class="text-[11px] text-gray-400 mt-1">Sabtu ini pukul 09:00 WIB di Ruang Guru Utama.</p>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-blue-500 bg-blue-50 px-2 py-0.5 rounded uppercase tracking-wider">Info</span>
                    <p class="font-bold text-gray-800 text-xs mt-2 hover:underline cursor-pointer">Batas Akhir Input Nilai UTS</p>
                    <p class="text-[11px] text-gray-400 mt-1">Mohon selesaikan rekap nilai sebelum tanggal 20 bulan ini.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection