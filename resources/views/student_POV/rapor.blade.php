@extends('layout.student.sidebar')

@section('content')
<div class="animate-in fade-in duration-300">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900">Transkrip Nilai & Rapor</h2>
            <p class="text-gray-500 text-sm mt-1">Pantau nilai akademis berkala dan rekapitulasi capaian belajarmu.</p>
        </div>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition-all shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Unduh Rapor PDF
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-gray-50/70 border-b border-gray-100">
                    <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest w-16 text-center">No</th>
                    <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Mata Pelajaran</th>
                    <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center">Tugas</th>
                    <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center">UTS</th>
                    <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center">UAS</th>
                    <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center">Nilai Akhir</th>
                    <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-medium text-gray-600">
                <tr class="hover:bg-slate-50/40 transition-all">
                    <td class="py-4 px-6 text-center font-bold text-gray-400">1</td>
                    <td class="py-4 px-6 font-bold text-gray-800">Matematika Wajib</td>
                    <td class="py-4 px-6 text-center">88</td>
                    <td class="py-4 px-6 text-center">85</td>
                    <td class="py-4 px-6 text-center">90</td>
                    <td class="py-4 px-6 text-center font-black text-indigo-600">87.5</td>
                    <td class="py-4 px-6 text-center">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black px-3 py-1 rounded-md border border-emerald-100 uppercase">Lulus</span>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50/40 transition-all">
                    <td class="py-4 px-6 text-center font-bold text-gray-400">2</td>
                    <td class="py-4 px-6 font-bold text-gray-800">Fisika</td>
                    <td class="py-4 px-6 text-center">80</td>
                    <td class="py-4 px-6 text-center">78</td>
                    <td class="py-4 px-6 text-center">85</td>
                    <td class="py-4 px-6 text-center font-black text-indigo-600">81.0</td>
                    <td class="py-4 px-6 text-center">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black px-3 py-1 rounded-md border border-emerald-100 uppercase">Lulus</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection