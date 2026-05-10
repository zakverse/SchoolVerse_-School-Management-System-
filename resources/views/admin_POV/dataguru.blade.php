@extends('layout.admin.sidebar')

@section('content')
<div class="min-h-screen bg-[#f4f7fb]">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Data Guru</h2>
            <p class="text-gray-500 text-sm mt-1">Manajemen data staf pengajar dan tenaga pendidik.</p>
        </div>
        <button onclick="toggleModal('addGuruModal')" class="bg-[#2563eb] hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-all shadow-lg shadow-blue-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Guru
        </button>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 mb-6 flex flex-wrap justify-between items-center gap-4">
        <div class="flex items-center gap-3 flex-1">
            <div class="relative w-full max-w-xs">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Cari Nama atau NIP..." class="w-full border border-gray-200 rounded-lg pl-9 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700">
            </div>
            <button class="border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Filter Mapel
            </button>
        </div>

        <div class="flex bg-gray-100 p-1 rounded-lg">
            <button onclick="switchView('grid')" id="btn-grid" class="p-2 rounded-md transition-all bg-white shadow-sm text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </button>
            <button onclick="switchView('table')" id="btn-table" class="p-2 rounded-md transition-all text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>

    @php
        $teachers = [
            ['name' => 'Budi Santoso, M.Pd', 'nip' => '198001012005011001', 'mapel' => 'Matematika', 'jabatan' => 'Wali Kelas', 'img' => 'https://i.pravatar.cc/150?u=budi'],
            ['name' => 'Siti Aminah, S.Pd', 'nip' => '198203152006042002', 'mapel' => 'Bahasa Inggris', 'jabatan' => 'Guru Mapel', 'img' => 'https://i.pravatar.cc/150?u=siti'],
            ['name' => 'Drs. Ahmad Dahlan', 'nip' => '197505202000031003', 'mapel' => 'Fisika', 'jabatan' => 'Wakasek Kurikulum', 'img' => ''],
            ['name' => 'Rina Wijaya, S.Pd', 'nip' => '198508102010012004', 'mapel' => 'Sejarah', 'jabatan' => 'Guru Mapel', 'img' => ''],
        ];
    @endphp

    <div id="view-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($teachers as $teacher)
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 text-center relative group hover:shadow-md transition-all">
            <button class="absolute top-4 right-4 text-gray-300 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
            </button>
            <div class="mb-4 flex justify-center">
                @if($teacher['img'])
                    <img src="{{ $teacher['img'] }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-50">
                @else
                    <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold text-2xl uppercase">{{ substr($teacher['name'], 0, 1) }}</div>
                @endif
            </div>
            <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $teacher['name'] }}</h4>
            <p class="text-[11px] text-gray-400 mb-4 font-medium uppercase tracking-wider">NIP. {{ $teacher['nip'] }}</p>
            <div class="space-y-2 mb-6">
                <span class="block bg-blue-50 text-blue-500 text-[10px] font-bold px-3 py-1 rounded-full w-max mx-auto border border-blue-100">{{ $teacher['mapel'] }}</span>
                <span class="block bg-gray-50 text-gray-500 text-[10px] font-bold px-3 py-1 rounded-full w-max mx-auto border border-gray-100">{{ $teacher['jabatan'] }}</span>
            </div>
            <div class="flex justify-center gap-6 pt-4 border-t border-gray-50 text-gray-400">
                <button class="hover:text-blue-500 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></button>
                <button class="hover:text-blue-500 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 00-2 2z"/></svg></button>
            </div>
        </div>
        @endforeach
    </div>

    <div id="view-table" class="bg-white rounded-xl border border-gray-100 shadow-sm hidden overflow-hidden">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase">Nama Guru</th>
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase">NIP</th>
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase">Mata Pelajaran</th>
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase">Jabatan</th>
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($teachers as $teacher)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                    <td class="py-4 px-6 flex items-center gap-3 font-medium text-gray-800">
                        @if($teacher['img']) <img src="{{ $teacher['img'] }}" class="w-8 h-8 rounded-full"> @else <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-400">{{ substr($teacher['name'], 0, 1) }}</div> @endif
                        {{ $teacher['name'] }}
                    </td>
                    <td class="py-4 px-6 text-gray-400 font-medium">{{ $teacher['nip'] }}</td>
                    <td class="py-4 px-6"><span class="bg-blue-50 text-blue-500 text-[10px] font-bold px-2.5 py-0.5 rounded-full border border-blue-100 uppercase">{{ $teacher['mapel'] }}</span></td>
                    <td class="py-4 px-6 text-gray-500">{{ $teacher['jabatan'] }}</td>
                    <td class="py-4 px-6 text-right">
                        <button class="text-gray-300 hover:text-gray-600"><svg class="w-5 h-5 ml-auto" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="addGuruModal" class="fixed inset-0 z-[60] bg-gray-900/40 backdrop-blur-sm hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-[500px] overflow-hidden">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Tambah Data Guru</h3>
                <button onclick="toggleModal('addGuruModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-8 space-y-6">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">NIP</label>
                    <input type="text" placeholder="Masukkan NIP..." class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap beserta Gelar</label>
                    <input type="text" placeholder="Contoh: Budi Santoso, S.Pd" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700">
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Mata Pelajaran</label>
                        <select class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
                            <option>Matematika</option>
                            <option>Bahasa Inggris</option>
                            <option>Fisika</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Jabatan</label>
                        <select class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
                            <option>Guru Mapel</option>
                            <option>Wali Kelas</option>
                            <option>Wakasek Kurikulum</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
                <button onclick="toggleModal('addGuruModal')" class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">Batal</button>
                <button class="px-8 py-2.5 text-sm font-bold text-white bg-[#2563eb] rounded-xl hover:bg-blue-700 transition-colors shadow-lg shadow-blue-200">Simpan</button>
            </div>
        </div>
    </div>

    <script>
        function switchView(view) {
            const gridView = document.getElementById('view-grid');
            const tableView = document.getElementById('view-table');
            const btnGrid = document.getElementById('btn-grid');
            const btnTable = document.getElementById('btn-table');

            if (view === 'grid') {
                gridView.classList.remove('hidden');
                tableView.classList.add('hidden');
                btnGrid.classList.add('bg-white', 'shadow-sm', 'text-blue-600');
                btnGrid.classList.remove('text-gray-400');
                btnTable.classList.remove('bg-white', 'shadow-sm', 'text-blue-600');
                btnTable.classList.add('text-gray-400');
            } else {
                gridView.classList.add('hidden');
                tableView.classList.remove('hidden');
                btnTable.classList.add('bg-white', 'shadow-sm', 'text-blue-600');
                btnTable.classList.remove('text-gray-400');
                btnGrid.classList.remove('bg-white', 'shadow-sm', 'text-blue-600');
                btnGrid.classList.add('text-gray-400');
            }
        }

        function toggleModal(id) {
            const m = document.getElementById(id);
            m.classList.toggle('hidden');
        }
    </script>
@endsection