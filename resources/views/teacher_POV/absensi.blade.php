@extends('layout.teacher.sidebar')

@section('content')
<div class="animate-in fade-in duration-300">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900">Presensi & Absensi Siswa</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola kehadiran siswa secara real-time per jam pelajaran.</p>
        </div>
        <div class="bg-blue-50 border border-blue-100 rounded-xl px-4 py-2.5 flex items-center gap-2 text-blue-700 text-sm font-bold">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            {{ Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6 flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-4 flex-1">
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Kelas:</span>
                <select class="border border-gray-200 rounded-xl px-4 py-2 text-sm font-bold bg-white text-gray-700 outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    <option>X MIPA 1 (Matematika Wajib)</option>
                    <option>X MIPA 2 (Matematika Wajib)</option>
                    <option>XI MIPA 3 (Matematika Peminatan)</option>
                </select>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Jam Ke:</span>
                <select class="border border-gray-200 rounded-xl px-4 py-2 text-sm font-bold bg-white text-gray-700 outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    <option>2 - 3 (07:45 - 09:15)</option>
                    <option>5 - 6 (10:00 - 11:30)</option>
                </select>
            </div>
        </div>
        
        <div class="flex gap-4 text-xs font-bold">
            <span class="text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100">Hadir: 32</span>
            <span class="text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100">Izin: 0</span>
            <span class="text-amber-600 bg-amber-50 px-3 py-1.5 rounded-lg border border-amber-100">Sakit: 0</span>
            <span class="text-red-600 bg-red-50 px-3 py-1.5 rounded-lg border border-red-100">Alpa: 0</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-8">
        <form action="#" method="POST">
            @csrf
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50/70 border-b border-gray-100">
                            <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest w-20">No</th>
                            <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest w-40">NIS</th>
                            <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Nama Siswa</th>
                            <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center w-[350px]">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 divide-y divide-gray-50 font-medium">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6 text-gray-400 font-bold">1</td>
                            <td class="py-4 px-6 text-gray-400">21001</td>
                            <td class="py-4 px-6 font-bold text-gray-800">Ahmad Fauzi</td>
                            <td class="py-4 px-6">
                                <div class="flex justify-center gap-2">
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21001]" value="H" checked class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-emerald-50 peer-checked:text-emerald-600 peer-checked:border-emerald-200 transition-all">Hadir</span>
                                    </label>
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21001]" value="I" class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-blue-50 peer-checked:text-blue-600 peer-checked:border-blue-200 transition-all">Izin</span>
                                    </label>
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21001]" value="S" class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-amber-50 peer-checked:text-amber-600 peer-checked:border-amber-200 transition-all">Sakit</span>
                                    </label>
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21001]" value="A" class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-red-50 peer-checked:text-red-600 peer-checked:border-red-200 transition-all">Alpa</span>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6 text-gray-400 font-bold">2</td>
                            <td class="py-4 px-6 text-gray-400">21002</td>
                            <td class="py-4 px-6 font-bold text-gray-800">Diana Putri</td>
                            <td class="py-4 px-6">
                                <div class="flex justify-center gap-2">
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21002]" value="H" checked class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-emerald-50 peer-checked:text-emerald-600 peer-checked:border-emerald-200 transition-all">Hadir</span>
                                    </label>
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21002]" value="I" class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-blue-50 peer-checked:text-blue-600 peer-checked:border-blue-200 transition-all">Izin</span>
                                    </label>
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21002]" value="S" class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-amber-50 peer-checked:text-amber-600 peer-checked:border-amber-200 transition-all">Sakit</span>
                                    </label>
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21002]" value="A" class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-red-50 peer-checked:text-red-600 peer-checked:border-red-200 transition-all">Alpa</span>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6 text-gray-400 font-bold">3</td>
                            <td class="py-4 px-6 text-gray-400">21003</td>
                            <td class="py-4 px-6 font-bold text-gray-800">Eko Prasetyo</td>
                            <td class="py-4 px-6">
                                <div class="flex justify-center gap-2">
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21003]" value="H" checked class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-emerald-50 peer-checked:text-emerald-600 peer-checked:border-emerald-200 transition-all">Hadir</span>
                                    </label>
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21003]" value="I" class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-blue-50 peer-checked:text-blue-600 peer-checked:border-blue-200 transition-all">Izin</span>
                                    </label>
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21003]" value="S" class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-amber-50 peer-checked:text-amber-600 peer-checked:border-amber-200 transition-all">Sakit</span>
                                    </label>
                                    <label class="flex-1 text-center cursor-pointer">
                                        <input type="radio" name="status[21003]" value="A" class="peer hidden">
                                        <span class="block py-2 rounded-xl text-xs font-bold border border-gray-100 text-gray-400 bg-gray-50/50 peer-checked:bg-red-50 peer-checked:text-red-600 peer-checked:border-red-200 transition-all">Alpa</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                <p class="text-xs font-medium text-gray-400">Pastikan semua siswa sudah dicek sebelum menyimpan.</p>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-100 text-sm">
                    Simpan Presensi Hari Ini
                </button>
            </div>
        </form>
    </div>
</div>
@endsection