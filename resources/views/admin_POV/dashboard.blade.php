@extends('layout.admin.sidebar')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 font-medium mb-0.5">Total Siswa</div>
                <div class="text-2xl font-bold text-gray-800">{{ number_format($totalSiswa) }}</div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 font-medium mb-0.5">Total Guru</div>
                <div class="text-2xl font-bold text-gray-800">{{ number_format($totalGuru) }}</div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 bg-sky-50 text-sky-500 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 font-medium mb-0.5">Kehadiran Hari Ini</div>
                <div class="text-2xl font-bold text-gray-800">{{ $kehadiranHariIni }}%</div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 font-medium mb-0.5">Kelas Aktif</div>
                <div class="text-2xl font-bold text-gray-800">{{ $kelasAktif }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
            <h3 class="text-gray-800 font-semibold text-[15px] mb-6">Statistik Kehadiran Mingguan (%)</h3>
            
            <div class="pl-8 pr-4">
                <div class="relative h-56 mt-4">
                    <div class="absolute inset-0 flex flex-col justify-between z-0">
                        <div class="border-t border-dashed border-gray-200 flex-1 relative"><span class="absolute -top-2.5 -left-8 text-xs text-gray-400">100</span></div>
                        <div class="border-t border-dashed border-gray-200 flex-1 relative"><span class="absolute -top-2.5 -left-8 text-xs text-gray-400">75</span></div>
                        <div class="border-t border-dashed border-gray-200 flex-1 relative"><span class="absolute -top-2.5 -left-8 text-xs text-gray-400">50</span></div>
                        <div class="border-t border-dashed border-gray-200 flex-1 relative"><span class="absolute -top-2.5 -left-8 text-xs text-gray-400">25</span></div>
                        <div class="border-t border-dashed border-gray-200 relative"><span class="absolute -top-2.5 -left-8 text-xs text-gray-400">0</span></div>
                    </div>

                    <div class="absolute inset-0 flex items-end justify-between px-8 z-10">
                        @foreach($chartData as $day => $percentage)
                            <div class="w-10 bg-[#38bdf8] rounded-t-sm" style="height: {{ $percentage }}%;" title="{{ $day }}: {{ $percentage }}%"></div>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex justify-between mt-3 px-8 text-gray-400 text-xs font-medium">
                    <span class="w-10 text-center">Sen</span>
                    <span class="w-10 text-center">Sel</span>
                    <span class="w-10 text-center">Rab</span>
                    <span class="w-10 text-center">Kam</span>
                    <span class="w-10 text-center">Jum</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-gray-800 font-semibold text-[15px]">Pengumuman</h3>
                <a href="#" class="text-xs text-blue-500 hover:text-blue-600 font-medium">Lihat Semua</a>
            </div>
            <div class="space-y-5">
                <div class="pb-5 border-b border-gray-100 last:border-0">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-red-50 text-red-500 text-[10px] font-bold px-2 py-0.5 rounded-full">PENTING</span>
                        <span class="text-[11px] text-gray-400 ml-auto">12 Okt 2026</span>
                    </div>
                    <p class="text-sm font-medium text-gray-700">Persiapan Ujian Tengah Semester</p>
                </div>
                <div class="pb-5 border-b border-gray-100 last:border-0">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-blue-50 text-blue-500 text-[10px] font-bold px-2 py-0.5 rounded-full">INFO</span>
                        <span class="text-[11px] text-gray-400 ml-auto">10 Okt 2026</span>
                    </div>
                    <p class="text-sm font-medium text-gray-700">Rapat Wali Murid Kelas X</p>
                </div>
                <div class="pb-5 border-b border-gray-100 last:border-0">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-green-50 text-emerald-500 text-[10px] font-bold px-2 py-0.5 rounded-full">LIBUR</span>
                        <span class="text-[11px] text-gray-400 ml-auto">08 Okt 2026</span>
                    </div>
                    <p class="text-sm font-medium text-gray-700">Libur Nasional Maulid Nabi</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm mb-8">
        <h3 class="text-gray-800 font-semibold text-[15px] mb-5">Jadwal Pelajaran Hari Ini</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="py-3 px-4 font-medium text-gray-400 text-xs uppercase tracking-wider">Waktu</th>
                        <th class="py-3 px-4 font-medium text-gray-400 text-xs uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="py-3 px-4 font-medium text-gray-400 text-xs uppercase tracking-wider">Kelas</th>
                        <th class="py-3 px-4 font-medium text-gray-400 text-xs uppercase tracking-wider">Guru</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    @forelse($todaySchedules as $sch)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4">{{ \Carbon\Carbon::parse($sch->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($sch->end_time)->format('H:i') }}</td>
                            <td class="py-4 px-4">{{ $sch->subject }}</td>
                            <td class="py-4 px-4">{{ $sch->class }}</td>
                            <td class="py-4 px-4">{{ $sch->teacher->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 px-4 text-center text-gray-400">Tidak ada jadwal pelajaran hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection