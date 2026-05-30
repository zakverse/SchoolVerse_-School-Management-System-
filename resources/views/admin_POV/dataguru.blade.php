@extends('layout.admin.sidebar')

@section('content')
<div class="min-h-screen bg-[#f4f7fb]">
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 bg-rose-50 border border-rose-200 text-rose-600 rounded-xl text-sm font-medium">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

    <!-- Search & Filter Form -->
    <form action="{{ route('admin.dataguru') }}" method="GET" class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 mb-6 flex flex-wrap justify-between items-center gap-4">
        <div class="flex items-center gap-3 flex-1">
            <div class="relative w-full max-w-xs">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari Nama atau NIP..." class="w-full border border-gray-200 rounded-lg pl-9 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700">
            </div>
            <select name="mapel" onchange="this.form.submit()" class="border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm font-medium bg-white">
                <option value="">Semua Mapel</option>
                @foreach($mapels as $m)
                    <option value="{{ $m }}" {{ $mapelFilter == $m ? 'selected' : '' }}>{{ $m }}</option>
                @endforeach
            </select>
            @if($search || $mapelFilter)
                <a href="{{ route('admin.dataguru') }}" class="text-xs text-gray-500 hover:text-blue-500">Reset</a>
            @endif
        </div>

        <div class="flex bg-gray-100 p-1 rounded-lg">
            <button type="button" onclick="switchView('grid')" id="btn-grid" class="p-2 rounded-md transition-all bg-white shadow-sm text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </button>
            <button type="button" onclick="switchView('table')" id="btn-table" class="p-2 rounded-md transition-all text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </form>

    <!-- Grid View -->
    <div id="view-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($teachers as $teacher)
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 text-center relative group hover:shadow-md transition-all">
            <div class="absolute top-4 right-4 flex gap-1">
                <!-- Edit button -->
                <button onclick="openEditModal({{ $teacher->id }}, '{{ $teacher->nip }}', '{{ addslashes($teacher->name) }}', '{{ $teacher->mapel }}', '{{ $teacher->jabatan }}', '{{ $teacher->status }}')" class="text-gray-300 hover:text-blue-500 transition-colors" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </button>
                <!-- Delete button -->
                <form action="{{ route('admin.dataguru.delete', $teacher->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus guru ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-300 hover:text-rose-500 transition-colors" title="Hapus">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
            <div class="mb-4 flex justify-center">
                @if($teacher->profile_picture)
                    <img src="{{ $teacher->profile_picture }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-50">
                @else
                    <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold text-2xl uppercase border border-gray-100 shadow-sm">{{ substr($teacher->name, 0, 1) }}</div>
                @endif
            </div>
            <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $teacher->name }}</h4>
            <p class="text-[11px] text-gray-400 mb-4 font-medium uppercase tracking-wider">NIP. {{ $teacher->nip }}</p>
            <div class="space-y-2 mb-6">
                <span class="block bg-blue-50 text-blue-500 text-[10px] font-bold px-3 py-1 rounded-full w-max mx-auto border border-blue-100">{{ $teacher->mapel }}</span>
                <span class="block bg-gray-50 text-gray-500 text-[10px] font-bold px-3 py-1 rounded-full w-max mx-auto border border-gray-100">{{ $teacher->jabatan }}</span>
                @if($teacher->status === 'active')
                    <span class="inline-block bg-emerald-50 text-emerald-500 border border-emerald-100 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Aktif</span>
                @else
                    <span class="inline-block bg-gray-100 text-gray-400 border border-gray-200 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Nonaktif</span>
                @endif
            </div>
        </div>
        @empty
            <div class="col-span-4 bg-white rounded-xl border border-gray-100 p-8 text-center text-gray-400">
                Data guru tidak ditemukan.
            </div>
        @endforelse
    </div>

    <!-- Table View -->
    <div id="view-table" class="bg-white rounded-xl border border-gray-100 shadow-sm hidden overflow-hidden">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase">Nama Guru</th>
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase">NIP</th>
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase">Mata Pelajaran</th>
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase">Jabatan</th>
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase">Status</th>
                    <th class="py-4 px-6 font-semibold text-gray-400 text-xs uppercase text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse($teachers as $teacher)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                    <td class="py-4 px-6 flex items-center gap-3 font-medium text-gray-800">
                        @if($teacher->profile_picture)
                            <img src="{{ $teacher->profile_picture }}" class="w-8 h-8 rounded-full">
                        @else
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-400 border">{{ substr($teacher->name, 0, 1) }}</div>
                        @endif
                        {{ $teacher->name }}
                    </td>
                    <td class="py-4 px-6 text-gray-400 font-medium">{{ $teacher->nip }}</td>
                    <td class="py-4 px-6"><span class="bg-blue-50 text-blue-500 text-[10px] font-bold px-2.5 py-0.5 rounded-full border border-blue-100 uppercase">{{ $teacher->mapel }}</span></td>
                    <td class="py-4 px-6 text-gray-500">{{ $teacher->jabatan }}</td>
                    <td class="py-4 px-6">
                        @if($teacher->status === 'active')
                            <span class="bg-emerald-50 text-emerald-500 border border-emerald-100 text-[10px] font-medium px-2 py-0.5 rounded-full">Aktif</span>
                        @else
                            <span class="bg-gray-100 text-gray-400 border border-gray-200 text-[10px] font-medium px-2 py-0.5 rounded-full">Nonaktif</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center justify-end gap-3">
                            <button onclick="openEditModal({{ $teacher->id }}, '{{ $teacher->nip }}', '{{ addslashes($teacher->name) }}', '{{ $teacher->mapel }}', '{{ $teacher->jabatan }}', '{{ $teacher->status }}')" class="text-blue-500 hover:text-blue-700" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="{{ route('admin.dataguru.delete', $teacher->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus guru ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-500 hover:text-rose-700" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 px-6 text-center text-gray-400">Data guru tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $teachers->links() }}
    </div>

    <!-- Add Guru Modal -->
    <div id="addGuruModal" class="fixed inset-0 z-[60] bg-gray-900/40 backdrop-blur-sm hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-[500px] overflow-hidden">
            <form action="{{ route('admin.dataguru.post') }}" method="POST">
                @csrf
                <div class="flex justify-between items-center p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Tambah Data Guru</h3>
                    <button type="button" onclick="toggleModal('addGuruModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="p-8 space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">NIP</label>
                        <input type="text" name="nip" required placeholder="Masukkan NIP..." class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap beserta Gelar</label>
                        <input type="text" name="name" required placeholder="Contoh: Budi Santoso, M.Pd" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700">
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Mata Pelajaran</label>
                            <select name="mapel" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
                                <option value="Matematika">Matematika</option>
                                <option value="Bahasa Inggris">Bahasa Inggris</option>
                                <option value="Fisika">Fisika</option>
                                <option value="Kimia">Kimia</option>
                                <option value="Biologi">Biologi</option>
                                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                <option value="Sejarah">Sejarah</option>
                                <option value="Pendidikan Agama">Pendidikan Agama</option>
                                <option value="PJOK">PJOK</option>
                                <option value="Seni Budaya">Seni Budaya</option>
                                <option value="PPKn">PPKn</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Jabatan</label>
                            <select name="jabatan" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
                                <option value="Guru Mapel">Guru Mapel</option>
                                <option value="Wali Kelas">Wali Kelas</option>
                                <option value="Wakasek Kurikulum">Wakasek Kurikulum</option>
                                <option value="Kepala Sekolah">Kepala Sekolah</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
                    <button type="button" onclick="toggleModal('addGuruModal')" class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">Batal</button>
                    <button type="submit" class="px-8 py-2.5 text-sm font-bold text-white bg-[#2563eb] rounded-xl hover:bg-blue-700 transition-colors shadow-lg shadow-blue-200">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Guru Modal -->
    <div id="editGuruModal" class="fixed inset-0 z-[60] bg-gray-900/40 backdrop-blur-sm hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-[500px] overflow-hidden">
            <form id="edit-form" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="flex justify-between items-center p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Edit Data Guru</h3>
                    <button type="button" onclick="toggleModal('editGuruModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="p-8 space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">NIP</label>
                        <input type="text" id="edit-nip" name="nip" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap beserta Gelar</label>
                        <input type="text" id="edit-name" name="name" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700">
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Mata Pelajaran</label>
                            <select id="edit-mapel" name="mapel" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
                                <option value="Matematika">Matematika</option>
                                <option value="Bahasa Inggris">Bahasa Inggris</option>
                                <option value="Fisika">Fisika</option>
                                <option value="Kimia">Kimia</option>
                                <option value="Biologi">Biologi</option>
                                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                <option value="Sejarah">Sejarah</option>
                                <option value="Pendidikan Agama">Pendidikan Agama</option>
                                <option value="PJOK">PJOK</option>
                                <option value="Seni Budaya">Seni Budaya</option>
                                <option value="PPKn">PPKn</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Jabatan</label>
                            <select id="edit-jabatan" name="jabatan" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
                                <option value="Guru Mapel">Guru Mapel</option>
                                <option value="Wali Kelas">Wali Kelas</option>
                                <option value="Wakasek Kurikulum">Wakasek Kurikulum</option>
                                <option value="Kepala Sekolah">Kepala Sekolah</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Status Akun</label>
                        <select id="edit-status" name="status" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
                            <option value="active">Aktif</option>
                            <option value="inactive">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
                    <button type="button" onclick="toggleModal('editGuruModal')" class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">Batal</button>
                    <button type="submit" class="px-8 py-2.5 text-sm font-bold text-white bg-[#2563eb] rounded-xl hover:bg-blue-700 transition-colors shadow-lg">Simpan Perubahan</button>
                </div>
            </form>
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

        function openEditModal(id, nip, name, mapel, jabatan, status) {
            document.getElementById('edit-form').action = '/admin/data-guru/' + id;
            document.getElementById('edit-nip').value = nip;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-mapel').value = mapel;
            document.getElementById('edit-jabatan').value = jabatan;
            document.getElementById('edit-status').value = status;
            toggleModal('editGuruModal');
        }
    </script>
</div>
@endsection