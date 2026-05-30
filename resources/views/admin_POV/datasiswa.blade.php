@extends('layout.admin.sidebar')

@section('content')
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
            <h2 class="text-2xl font-bold text-gray-800">Data Siswa</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola data seluruh siswa di sekolah.</p>
        </div>
        <button onclick="toggleModal('addStudentModal')" class="bg-[#2563eb] hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Siswa
        </button>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        
        <!-- Search & Filter Form -->
        <form action="{{ route('admin.datasiswa') }}" method="GET" class="p-5 border-b border-gray-100 flex justify-between items-center">
            <div class="relative w-[300px]">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari NIS atau Nama..." class="w-full border border-gray-200 rounded-lg pl-9 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>
            <div class="flex items-center gap-2">
                <select name="class" onchange="this.form.submit()" class="border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm font-medium bg-white outline-none">
                    <option value="">Semua Kelas</option>
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ $classFilter == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
                @if($search || $classFilter)
                    <a href="{{ route('admin.datasiswa') }}" class="text-xs text-gray-500 hover:text-blue-500">Reset</a>
                @endif
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white border-b border-gray-100">
                        <th class="py-3 px-6 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Profil</th>
                        <th class="py-3 px-6 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">NIS</th>
                        <th class="py-3 px-6 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Nama Siswa</th>
                        <th class="py-3 px-6 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Kelas</th>
                        <th class="py-3 px-6 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-6 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse($students as $student)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-6">
                            <div class="w-8 h-8 rounded-full bg-slate-100 border text-slate-500 font-bold flex items-center justify-center text-xs uppercase">{{ substr($student->name, 0, 1) }}</div>
                        </td>
                        <td class="py-3 px-6 text-gray-500">{{ $student->nis }}</td>
                        <td class="py-3 px-6 font-medium text-gray-800">{{ $student->name }}</td>
                        <td class="py-3 px-6 text-gray-500">{{ $student->class }}</td>
                        <td class="py-3 px-6">
                            @if($student->status === 'active')
                                <span class="bg-emerald-50 text-emerald-500 border border-emerald-100 text-[11px] font-medium px-2.5 py-0.5 rounded-full">Aktif</span>
                            @else
                                <span class="bg-gray-100 text-gray-400 border border-gray-200 text-[11px] font-medium px-2.5 py-0.5 rounded-full">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 flex items-center gap-3 mt-1">
                            <!-- Edit Button -->
                            <button onclick="openEditModal({{ $student->id }}, '{{ $student->nis }}', '{{ addslashes($student->name) }}', '{{ $student->class }}', '{{ $student->gender }}', '{{ $student->status }}')" class="text-blue-500 hover:text-blue-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <!-- Delete Button -->
                            <form action="{{ route('admin.datasiswa.delete', $student->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-500 hover:text-rose-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-6 px-6 text-center text-gray-400">Data siswa tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="p-5 border-t border-gray-100 bg-white">
            {{ $students->links() }}
        </div>
    </div>

    <!-- Add Student Modal -->
    <div id="addStudentModal" class="fixed inset-0 z-50 bg-gray-900/40 backdrop-blur-sm hidden flex items-center justify-center transition-opacity">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-[500px] overflow-hidden transform scale-100">
            <form action="{{ route('admin.datasiswa.post') }}" method="POST">
                @csrf
                <div class="flex justify-between items-center p-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Tambah Data Siswa</h3>
                    <button type="button" onclick="toggleModal('addStudentModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">NIS</label>
                        <input type="text" name="nis" required placeholder="Masukkan NIS..." class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" required placeholder="Masukkan Nama..." class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Kelas</label>
                            <input type="text" name="class" required placeholder="Contoh: X MIPA 1" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis Kelamin</label>
                            <select name="gender" required class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white transition-all">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="p-5 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
                    <button type="button" onclick="toggleModal('addStudentModal')" class="px-5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-[#2563eb] rounded-lg hover:bg-blue-700 transition-colors shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div id="editStudentModal" class="fixed inset-0 z-50 bg-gray-900/40 backdrop-blur-sm hidden flex items-center justify-center transition-opacity">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-[500px] overflow-hidden transform scale-100">
            <form id="edit-form" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="flex justify-between items-center p-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Edit Data Siswa</h3>
                    <button type="button" onclick="toggleModal('editStudentModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">NIS</label>
                        <input type="text" id="edit-nis" name="nis" required class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" id="edit-name" name="name" required class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Kelas</label>
                            <input type="text" id="edit-class" name="class" required class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis Kelamin</label>
                            <select id="edit-gender" name="gender" required class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white transition-all">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Status Akun</label>
                        <select id="edit-status" name="status" required class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white transition-all">
                            <option value="active">Aktif</option>
                            <option value="inactive">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="p-5 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
                    <button type="button" onclick="toggleModal('editStudentModal')" class="px-5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-[#2563eb] rounded-lg hover:bg-blue-700 transition-colors shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
        }

        function openEditModal(id, nis, name, classVal, gender, status) {
            document.getElementById('edit-form').action = '/admin/data-siswa/' + id;
            document.getElementById('edit-nis').value = nis;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-class').value = classVal;
            document.getElementById('edit-gender').value = gender;
            document.getElementById('edit-status').value = status;
            toggleModal('editStudentModal');
        }
    </script>
@endsection