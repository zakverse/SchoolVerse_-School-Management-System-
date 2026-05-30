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
            <h2 class="text-2xl font-bold text-gray-800">Absensi Kehadiran Siswa</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola dan pantau kehadiran siswa harian.</p>
        </div>
        @if($activeSchedule)
            <button type="submit" form="attendance-form" class="bg-[#2563eb] hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-all shadow-lg shadow-blue-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Simpan Semua
            </button>
        @endif
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm mb-6">
        <form action="{{ route('admin.absensi') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Pilih Kelas</label>
                <select name="class" onchange="this.form.submit()" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ $activeClass == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Pilih Tanggal</label>
                <input type="date" name="date" value="{{ $activeDate }}" onchange="this.form.submit()" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Mata Pelajaran (Jadwal)</label>
                <select name="schedule_id" onchange="this.form.submit()" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @forelse($schedules as $sch)
                        <option value="{{ $sch->id }}" {{ $activeScheduleId == $sch->id ? 'selected' : '' }}>
                            {{ $sch->subject }} ({{ \Carbon\Carbon::parse($sch->start_time)->format('H:i') }} - {{ $sch->teacher->name }})
                        </option>
                    @empty
                        <option value="">Tidak ada jadwal di kelas ini</option>
                    @endforelse
                </select>
            </div>
        </form>
    </div>

    <!-- Attendance Form / Table -->
    @if($activeSchedule)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-8">
        <form id="attendance-form" action="{{ route('admin.absensi.post') }}" method="POST">
            @csrf
            <input type="hidden" name="schedule_id" value="{{ $activeSchedule->id }}">
            <input type="hidden" name="date" value="{{ $activeDate }}">

            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="py-4 px-6 font-bold text-gray-400 text-xs uppercase tracking-wider">Nama Siswa</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-xs uppercase tracking-wider">NIS</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-xs uppercase tracking-wider text-center">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($students as $std)
                        @php
                            $status = $todayLogs[$std->id] ?? 'Hadir';
                        @endphp
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 font-semibold text-gray-800">{{ $std->name }}</td>
                            <td class="py-4 px-6 text-gray-400 font-medium">{{ $std->nis }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status[{{ $std->id }}]" value="H" {{ $status == 'Hadir' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                                        <span class="text-xs font-bold text-gray-600 bg-blue-50 border border-blue-100 px-2.5 py-1 rounded-full uppercase">Hadir</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status[{{ $std->id }}]" value="I" {{ $status == 'Izin' ? 'checked' : '' }} class="text-amber-600 focus:ring-amber-500">
                                        <span class="text-xs font-bold text-gray-600 bg-amber-50 border border-amber-100 px-2.5 py-1 rounded-full uppercase">Izin</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status[{{ $std->id }}]" value="S" {{ $status == 'Sakit' ? 'checked' : '' }} class="text-purple-600 focus:ring-purple-500">
                                        <span class="text-xs font-bold text-gray-600 bg-purple-50 border border-purple-100 px-2.5 py-1 rounded-full uppercase">Sakit</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status[{{ $std->id }}]" value="A" {{ $status == 'Alpa' ? 'checked' : '' }} class="text-rose-600 focus:ring-rose-500">
                                        <span class="text-xs font-bold text-gray-600 bg-rose-50 border border-rose-100 px-2.5 py-1 rounded-full uppercase">Alpa</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center text-gray-400">Tidak ada data siswa aktif.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </form>
    </div>
    @else
        <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center text-gray-400">
            Silakan pilih kelas dan jadwal pelajaran terlebih dahulu untuk melihat catatan absensi.
        </div>
    @endif
</div>
@endsection
