@extends('layout.admin.sidebar')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Keuangan SPP</h2>
            <p class="text-gray-500 text-sm mt-1">Manajemen pembayaran SPP dan keuangan sekolah.</p>
        </div>
        <button onclick="toggleModal('modalBayar')" class="bg-[#2563eb] hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-all shadow-lg shadow-blue-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Input Pembayaran
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Total Penerimaan Bulan Ini</p>
            <h3 class="text-3xl font-black text-gray-800">Rp 8.500.000</h3>
            <p class="text-emerald-500 text-xs font-bold mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                +12% dari bulan lalu
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Total Tunggakan Aktif</p>
            <h3 class="text-3xl font-black text-gray-800">Rp 4.500.000</h3>
            <p class="text-gray-400 text-xs font-medium mt-2">15 siswa belum lunas</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm relative overflow-hidden">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Grafik Penerimaan</p>
            <div class="flex items-end gap-2 h-16">
                <div class="flex-1 bg-blue-100 rounded-t-sm h-[40%]"></div>
                <div class="flex-1 bg-blue-100 rounded-t-sm h-[60%]"></div>
                <div class="flex-1 bg-blue-100 rounded-t-sm h-[45%]"></div>
                <div class="flex-1 bg-[#2563eb] rounded-t-sm h-[90%]"></div>
                <div class="flex-1 bg-blue-100 rounded-t-sm h-[70%]"></div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-white">
            <div class="relative w-80">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Cari NIS atau Nama Siswa..." class="w-full border border-gray-200 rounded-xl pl-9 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            </div>
            <div class="flex gap-3">
                <select class="border border-gray-200 rounded-xl px-4 py-2 text-xs font-medium bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Semua Kelas</option>
                </select>
                <select class="border border-gray-200 rounded-xl px-4 py-2 text-xs font-medium bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Semua Status</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Siswa</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Tagihan</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Total Nominal</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Terbayar</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Sisa Tagihan</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Status</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 divide-y divide-gray-50">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6">
                            <p class="font-bold text-gray-800">Ahmad Fauzi</p>
                            <p class="text-[11px] text-gray-400">21001 - X MIPA 1</p>
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-500">Oktober 2023</td>
                        <td class="py-4 px-6 font-bold text-gray-700">Rp 250.000</td>
                        <td class="py-4 px-6 font-bold text-emerald-500">Rp 250.000</td>
                        <td class="py-4 px-6 font-bold text-gray-400">-</td>
                        <td class="py-4 px-6">
                            <span class="bg-emerald-50 text-emerald-500 border border-emerald-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase">Lunas</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button class="bg-blue-50 text-blue-600 p-2 rounded-lg hover:bg-blue-600 hover:text-white transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg></button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6">
                            <p class="font-bold text-gray-800">Siti Nurhaliza</p>
                            <p class="text-[11px] text-gray-400">21002 - X MIPA 1</p>
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-500">Oktober 2023</td>
                        <td class="py-4 px-6 font-bold text-gray-700">Rp 250.000</td>
                        <td class="py-4 px-6 font-bold text-emerald-500">Rp 100.000</td>
                        <td class="py-4 px-6 font-bold text-red-500">Rp 150.000</td>
                        <td class="py-4 px-6">
                            <span class="bg-orange-50 text-orange-500 border border-orange-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase">Cicilan</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button class="bg-blue-50 text-blue-600 p-2 rounded-lg hover:bg-blue-600 hover:text-white transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalBayar" class="fixed inset-0 z-[60] bg-gray-900/40 backdrop-blur-sm hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-[500px] overflow-hidden">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Input Pembayaran SPP</h3>
                <button onclick="toggleModal('modalBayar')" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-8 space-y-5">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Cari Nama Siswa</label>
                    <input type="text" placeholder="Masukkan Nama atau NIS..." class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Bulan Tagihan</label>
                        <select class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none">
                            <option>Oktober 2023</option>
                            <option>November 2023</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Jumlah Bayar</label>
                        <input type="number" placeholder="Rp 0" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold text-emerald-600">
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
                <button onclick="toggleModal('modalBayar')" class="px-6 py-2.5 text-sm font-bold text-gray-500">Batal</button>
                <button class="px-8 py-2.5 text-sm font-bold text-white bg-[#2563eb] rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">Simpan Pembayaran</button>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const m = document.getElementById(id);
            m.classList.toggle('hidden');
        }
    </script>
@endsection