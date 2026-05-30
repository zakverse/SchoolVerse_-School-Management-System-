@extends('layout.admin.sidebar')

@section('content')
<div class="min-h-screen bg-[#f4f7fb]">
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Rekap Nilai Siswa</h2>
            <p class="text-gray-500 text-sm mt-1">Pantau dan kelola nilai akademik siswa.</p>
        </div>
        <button type="submit" form="grades-form" class="bg-[#2563eb] hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-all shadow-lg shadow-blue-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
            Simpan Semua
        </button>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm mb-6">
        <form action="{{ route('admin.nilai') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Pilih Kelas</label>
                <select name="class" onchange="this.form.submit()" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ $activeClass == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Pilih Mata Pelajaran</label>
                <select name="subject" onchange="this.form.submit()" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($subjects as $sub)
                        <option value="{{ $sub }}" {{ $activeSubject == $sub ? 'selected' : '' }}>{{ $sub }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Pilih Kategori Nilai</label>
                <select name="category" onchange="this.form.submit()" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $activeCategory == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <!-- Table Grades Input -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-8">
        <form id="grades-form" action="{{ route('admin.nilai.post') }}" method="POST">
            @csrf
            <input type="hidden" name="class" value="{{ $activeClass }}">
            <input type="hidden" name="subject" value="{{ $activeSubject }}">
            <input type="hidden" name="category" value="{{ $activeCategory }}">

            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="py-4 px-6 font-bold text-gray-400 text-xs uppercase tracking-wider">Nama Siswa</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-xs uppercase tracking-wider">NIS</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-xs uppercase tracking-wider w-32">Nilai Angka</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-xs uppercase tracking-wider">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($students as $std)
                        @php
                            $score = $gradesData[$std->id]['score'] ?? '';
                            $notes = $gradesData[$std->id]['notes'] ?? '';
                        @endphp
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 font-semibold text-gray-800">{{ $std->name }}</td>
                            <td class="py-4 px-6 text-gray-400 font-medium">{{ $std->nis }}</td>
                            <td class="py-4 px-6">
                                <input type="number" min="0" max="100" name="grades[{{ $std->id }}][score]" value="{{ $score }}" placeholder="0-100" class="w-24 border border-gray-200 rounded-lg px-3 py-2 text-center text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-gray-800">
                            </td>
                            <td class="py-4 px-6">
                                <input type="text" name="grades[{{ $std->id }}][notes]" value="{{ $notes }}" placeholder="Tambahkan catatan..." class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-gray-400">Tidak ada data siswa aktif.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </form>
    </div>
</div>
@endsection
