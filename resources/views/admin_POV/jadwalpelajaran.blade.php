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
            <h2 class="text-2xl font-bold text-gray-800">Jadwal Pelajaran</h2>
            <p class="text-gray-500 text-sm mt-1">Jadwal mingguan kelas {{ $activeClass }} Semester Ganjil.</p>
        </div>
        <div class="flex gap-3">
            <button onclick="toggleModal('addScheduleModal')" class="bg-[#2563eb] hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-all shadow-lg shadow-blue-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Jadwal
            </button>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
        <form action="{{ route('admin.jadwal') }}" method="GET" class="flex justify-between items-center mb-8 border-b border-gray-50 pb-6">
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-500">Pilih Kelas:</span>
                <select name="class" onchange="this.form.submit()" class="border border-gray-200 rounded-xl px-4 py-2 text-sm font-bold bg-white outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ $activeClass == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-xs font-semibold text-gray-400">Total Slot: {{ $schedules->count() }} Jadwal</div>
        </form>

        <!-- Daily columns -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                <div class="bg-gray-50/50 rounded-xl p-4 border border-gray-100 min-h-[350px]">
                    <h3 class="font-bold text-center text-sm text-[#1e2f4c] bg-slate-200/50 rounded-lg py-2 mb-4">{{ $day }}</h3>
                    
                    <div class="space-y-3">
                        @php
                            $daySchedules = $schedules->where('day', $day)->sortBy('start_time');
                        @endphp
                        @forelse($daySchedules as $sch)
                            <div class="bg-white rounded-xl p-3 border border-gray-100 shadow-sm relative group hover:border-blue-200 transition-all">
                                <form action="{{ route('admin.jadwal.delete', $sch->id) }}" method="POST" class="absolute top-2 right-2 hidden group-hover:block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-rose-500" title="Hapus">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                                <p class="text-[#2563eb] font-bold text-sm mb-1">{{ $sch->subject }}</p>
                                <p class="text-[11px] text-gray-500 font-medium">{{ $sch->teacher->name }}</p>
                                <div class="flex items-center gap-1 text-[10px] text-gray-400 mt-2 font-bold">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ \Carbon\Carbon::parse($sch->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($sch->end_time)->format('H:i') }}
                                </div>
                                <p class="text-[10px] text-gray-400 font-medium mt-0.5">Ruang: {{ $sch->room }}</p>
                            </div>
                        @empty
                            <div class="border border-dashed border-gray-200 rounded-xl py-6 flex items-center justify-center text-gray-300 font-bold text-xs">Kosong</div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Add Schedule Modal -->
<div id="addScheduleModal" class="fixed inset-0 z-50 bg-gray-900/40 backdrop-blur-sm hidden flex items-center justify-center transition-opacity">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-[500px] overflow-hidden transform scale-100">
        <form action="{{ route('admin.jadwal.post') }}" method="POST">
            @csrf
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Tambah Jadwal Pelajaran</h3>
                <button type="button" onclick="toggleModal('addScheduleModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="p-8 space-y-5">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kelas</label>
                    <input type="text" name="class" value="{{ $activeClass }}" readonly class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-500 font-medium outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Mata Pelajaran</label>
                    <input type="text" name="subject" required placeholder="Contoh: Matematika, Fisika, dll." class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Guru Pengajar</label>
                    <select name="teacher_id" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($teachers as $t)
                            <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->mapel }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Hari</label>
                        <select name="day" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Ruangan</label>
                        <input type="text" name="room" required placeholder="Contoh: R.101" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Waktu Mulai</label>
                        <input type="time" name="start_time" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Waktu Selesai</label>
                        <input type="time" name="end_time" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none">
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
                <button type="button" onclick="toggleModal('addScheduleModal')" class="px-6 py-2.5 text-sm font-bold text-gray-500">Batal</button>
                <button type="submit" class="px-8 py-2.5 text-sm font-bold text-white bg-[#2563eb] rounded-xl hover:bg-blue-700 transition-all shadow-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }
</script>
@endsection