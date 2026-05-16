@extends('layout.teacher.sidebar')

@section('content')
<div x-data="{ openModal: false }" class="animate-in fade-in duration-300">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900">Input Nilai & Rapor</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola perolehan nilai siswa secara transparan dan terorganisir.</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Import Excel
            </button>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 transition-all shadow-lg shadow-blue-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Simpan Semua
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Rata-rata Kelas</p>
            <h3 class="text-2xl font-black text-gray-800">82.4</h3>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nilai Tertinggi</p>
            <h3 class="text-2xl font-black text-emerald-600">98</h3>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nilai Terendah</p>
            <h3 class="text-2xl font-black text-red-500">64</h3>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Belum Tuntas</p>
            <h3 class="text-2xl font-black text-amber-500">3 Siswa</h3>
        </div>
    </div>

    <div class="bg-[#1e2f4c] rounded-2xl p-5 mb-6 flex flex-wrap items-center justify-between gap-4 text-white">
        <div class="flex flex-wrap items-center gap-6">
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kelas</span>
                <select class="bg-slate-800 border border-slate-700 rounded-xl px-4 py-2 text-xs font-bold outline-none focus:ring-2 focus:ring-blue-500 text-white">
                    <option>X MIPA 1</option>
                    <option>X MIPA 2</option>
                </select>
            </div>
            <div class="flex items-center gap-3 border-l border-slate-700/60 md:pl-6">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Mata Pelajaran</span>
                <select class="bg-slate-800 border border-slate-700 rounded-xl px-4 py-2 text-xs font-bold outline-none focus:ring-2 focus:ring-blue-500 text-white">
                    <option>Matematika Wajib</option>
                </select>
            </div>
            <div class="flex items-center gap-3 border-l border-slate-700/60 md:pl-6">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori</span>
                <select id="kategoriSelect" class="bg-slate-800 border border-slate-700 rounded-xl px-4 py-2 text-xs font-bold outline-none focus:ring-2 focus:ring-blue-500 text-white">
                    <option value="uts">UTS (Wajib)</option>
                    <option value="uas">UAS (Wajib)</option>
                    <option value="uh1">Ulangan Harian 1</option>
                    <option value="tugas">Tugas Mandiri</option>
                </select>
            </div>
        </div>

        <button onclick="toggleModal(true)" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 transition-all shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Tambah Kategori
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/70 border-b border-gray-100">
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest w-20 text-center">No</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Nama Siswa</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center w-48">Nilai Angka (0-100)</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center w-48">Status</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Catatan / Komentar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 text-center text-gray-400 font-bold text-sm">1</td>
                        <td class="py-4 px-6">
                            <p class="font-bold text-gray-800 text-sm">Ahmad Fauzi</p>
                            <p class="text-[10px] text-gray-400 font-medium tracking-wide">NIS: 21001</p>
                        </td>
                        <td class="py-4 px-6">
                            <input type="number" value="85" class="w-full text-center bg-gray-50 border border-gray-200 rounded-xl py-2 font-black text-gray-700 focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none transition-all">
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black px-3 py-1.5 rounded-lg border border-emerald-100 uppercase tracking-wider">Tuntas</span>
                        </td>
                        <td class="py-4 px-6">
                            <input type="text" placeholder="Tambahkan catatan..." class="w-full bg-transparent text-sm text-gray-500 placeholder:text-gray-300 outline-none focus:border-b focus:border-blue-300 pb-1">
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 text-center text-gray-400 font-bold text-sm">2</td>
                        <td class="py-4 px-6">
                            <p class="font-bold text-gray-800 text-sm">Diana Putri</p>
                            <p class="text-[10px] text-gray-400 font-medium tracking-wide">NIS: 21002</p>
                        </td>
                        <td class="py-4 px-6">
                            <input type="number" value="92" class="w-full text-center bg-gray-50 border border-gray-200 rounded-xl py-2 font-black text-gray-700 focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none transition-all">
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black px-3 py-1.5 rounded-lg border border-emerald-100 uppercase tracking-wider">Tuntas</span>
                        </td>
                        <td class="py-4 px-6">
                            <input type="text" placeholder="Tambahkan catatan..." class="w-full bg-transparent text-sm text-gray-500 placeholder:text-gray-300 outline-none focus:border-b focus:border-blue-300 pb-1">
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 text-center text-gray-400 font-bold text-sm">3</td>
                        <td class="py-4 px-6">
                            <p class="font-bold text-gray-800 text-sm">Eko Prasetyo</p>
                            <p class="text-[10px] text-gray-400 font-medium tracking-wide">NIS: 21003</p>
                        </td>
                        <td class="py-4 px-6">
                            <input type="number" value="65" class="w-full text-center bg-red-50 border border-red-100 rounded-xl py-2 font-black text-red-600 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none transition-all">
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-red-50 text-red-600 text-[10px] font-black px-3 py-1.5 rounded-lg border border-red-100 uppercase tracking-wider">Remedial</span>
                        </td>
                        <td class="py-4 px-6">
                            <input type="text" value="Perlu bimbingan ekstra pada bab aljabar" class="w-full bg-transparent text-sm text-gray-500 placeholder:text-gray-300 outline-none focus:border-b focus:border-blue-300 pb-1">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="kategoriModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div onclick="toggleModal(false)" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
        
        <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl relative z-10 border border-gray-100 animate-in zoom-in-95 duration-200">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-lg font-extrabold text-gray-900">Tambah Kategori Nilai</h3>
                <button onclick="toggleModal(false)" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-3.5 mb-5 text-xs text-blue-700 font-medium leading-relaxed">
                📌 <strong>Sistem Note:</strong> Kategori utama seperti <strong>UTS</strong> dan <strong>UAS</strong> dikunci secara default oleh kurikulum dan tidak dapat diubah.
            </div>

            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Nama Kategori Baru</label>
                    <input type="text" id="inputKategoriBaru" placeholder="Misal: Tugas Praktikum, Nilai Projek" 
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all text-gray-700">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Bobot Nilai (%) - Opsional</label>
                    <input type="number" placeholder="Contoh: 20" 
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all text-gray-700">
                </div>
            </div>

            <div class="flex gap-3 mt-6 justify-end">
                <button onclick="toggleModal(false)" class="px-4 py-2.5 rounded-xl border border-gray-200 text-gray-500 font-bold text-xs hover:bg-gray-50 transition-all">
                    Batal
                </button>
                <button onclick="tambahKategoriKeDropdown()" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs transition-all shadow-md">
                    Simpan Kategori
                </button>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleModal(show) {
        const modal = document.getElementById('kategoriModal');
        if (show) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
            document.getElementById('inputKategoriBaru').value = '';
        }
    }

    function tambahKategoriKeDropdown() {
        const inputNama = document.getElementById('inputKategoriBaru').value.trim();
        const selectKategori = document.getElementById('kategoriSelect');

        if (inputNama !== '') {
            // Buat elemen option baru
            const option = document.createElement('option');
            option.value = inputNama.toLowerCase().replace(/\s+/g, '_');
            option.text = inputNama;
            
            // Masukkan ke dropdown pilihan kategori
            selectKategori.add(option);
            
            // Otomatis pilih kategori yang baru dibuat
            selectKategori.value = option.value;

            // Tutup Modal
            toggleModal(false);
        } else {
            alert('Nama kategori tidak boleh kosong ya!');
        }
    }
</script>
@endsection