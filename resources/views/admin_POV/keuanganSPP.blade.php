@extends('layout.admin.sidebar')

@section('content')
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Keuangan SPP</h2>
            <p class="text-gray-500 text-sm mt-1">Manajemen pembayaran SPP dan keuangan sekolah.</p>
        </div>
    </div>

    @php
        $monthsIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $currentMonthName = $monthsIndo[\Carbon\Carbon::now()->month] ?? 'Bulan Ini';
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Penerimaan ({{ $currentMonthName }})</p>
            <h3 class="text-3xl font-black text-gray-800">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
            <p class="text-emerald-500 text-xs font-bold mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                Dana Pembayaran SPP Masuk
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tunggakan ({{ $currentMonthName }})</p>
            <h3 class="text-3xl font-black text-gray-800">Rp {{ number_format($totalArrears, 0, ',', '.') }}</h3>
            <p class="text-rose-500 text-xs font-bold mt-2">{{ $activeArrearsCount }} siswa belum lunas</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm relative overflow-hidden">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Metrik Keuangan</p>
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
        <!-- Search & Filters -->
        <form action="{{ route('admin.keuangan') }}" method="GET" class="p-5 border-b border-gray-100 flex justify-between items-center bg-white">
            <div class="relative w-80">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari NIS atau Nama Siswa..." class="w-full border border-gray-200 rounded-xl pl-9 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            </div>
            <div class="flex gap-3">
                <select name="class" onchange="this.form.submit()" class="border border-gray-200 rounded-xl px-4 py-2 text-xs font-medium bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kelas</option>
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ $classFilter == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
                <select name="status" onchange="this.form.submit()" class="border border-gray-200 rounded-xl px-4 py-2 text-xs font-medium bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="Lunas" {{ $statusFilter == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="Belum Lunas" {{ $statusFilter == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                </select>
                @if($search || $classFilter || $statusFilter)
                    <a href="{{ route('admin.keuangan') }}" class="text-xs text-gray-500 self-center hover:text-blue-500">Reset</a>
                @endif
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Siswa</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Tagihan</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Nominal</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Terbayar</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Sisa Tagihan</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Status</th>
                        <th class="py-4 px-6 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 divide-y divide-gray-50">
                    @forelse($payments as $p)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <p class="font-bold text-gray-800">{{ $p->student->name }}</p>
                                <p class="text-[11px] text-gray-400">{{ $p->student->nis }} - {{ $p->student->class }}</p>
                            </td>
                            <td class="py-4 px-6 font-medium text-gray-500">{{ $monthsIndo[$p->month] ?? $p->month }} {{ $p->year }}</td>
                            <td class="py-4 px-6 font-bold text-gray-700">Rp {{ number_format($p->amount, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 font-bold text-emerald-500">
                                Rp {{ $p->status === 'Lunas' ? number_format($p->amount, 0, ',', '.') : '0' }}
                            </td>
                            <td class="py-4 px-6 font-bold text-red-500">
                                Rp {{ $p->status === 'Lunas' ? '0' : number_format($p->amount, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6">
                                @if($p->status === 'Lunas')
                                    <span class="bg-emerald-50 text-emerald-500 border border-emerald-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase">Lunas</span>
                                @else
                                    <span class="bg-rose-50 text-rose-500 border border-rose-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase">Belum Lunas</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($p->status !== 'Lunas')
                                    <button onclick="confirmPayment({{ $p->id }}, '{{ addslashes($p->student->name) }}', '{{ $monthsIndo[$p->month] }} {{ $p->year }}', {{ $p->amount }})" class="bg-blue-50 text-blue-600 p-2 rounded-lg hover:bg-blue-600 hover:text-white transition-all" title="Bayar Sekarang">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    </button>
                                @else
                                    <span class="text-xs text-gray-400 font-medium">Selesai ({{ \Carbon\Carbon::parse($p->payment_date)->format('d/m/Y') }})</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-gray-400">Data pembayaran SPP tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-5 border-t border-gray-100">
            {{ $payments->links() }}
        </div>
    </div>

    <!-- Confirm Payment Modal -->
    <div id="modalBayar" class="fixed inset-0 z-[60] bg-gray-900/40 backdrop-blur-sm hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-[500px] overflow-hidden">
            <form action="{{ route('admin.keuangan.pay') }}" method="POST">
                @csrf
                <input type="hidden" name="payment_id" id="pay-payment-id">

                <div class="flex justify-between items-center p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Catat Pembayaran SPP</h3>
                    <button type="button" onclick="toggleModal('modalBayar')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="p-8 space-y-4">
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 text-sm text-blue-700">
                        Apakah Anda yakin ingin memproses transaksi pembayaran ini?
                    </div>
                    <div class="space-y-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Siswa</p>
                        <p class="text-sm font-bold text-gray-800" id="pay-student-name">-</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Tagihan Bulan</p>
                        <p class="text-sm font-medium text-gray-800" id="pay-month">-</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Jumlah Pembayaran</p>
                        <p class="text-lg font-black text-emerald-600" id="pay-amount">-</p>
                    </div>
                </div>
                <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-gray-50">
                    <button type="button" onclick="toggleModal('modalBayar')" class="px-6 py-2.5 text-sm font-bold text-gray-500">Batal</button>
                    <button type="submit" class="px-8 py-2.5 text-sm font-bold text-white bg-[#2563eb] rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">Konfirmasi Pembayaran</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const m = document.getElementById(id);
            m.classList.toggle('hidden');
        }

        function confirmPayment(paymentId, name, monthYear, amount) {
            document.getElementById('pay-payment-id').value = paymentId;
            document.getElementById('pay-student-name').innerText = name;
            document.getElementById('pay-month').innerText = monthYear;
            document.getElementById('pay-amount').innerText = 'Rp ' + Number(amount).toLocaleString('id-ID');
            toggleModal('modalBayar');
        }
    </script>
@endsection