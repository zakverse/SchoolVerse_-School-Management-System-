@extends('layout.student.sidebar')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="mb-6">
        <h2 class="text-2xl font-black text-slate-800 leading-tight">Riwayat Pembayaran SPP</h2>
        <p class="text-slate-500 text-sm mt-1">Pantau rincian biaya SPP bulanan Anda.</p>
    </div>

    @php
        $monthsIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $totalBills = $payments->count();
        $paidCount = $payments->where('status', 'Lunas')->count();
        $unpaidCount = $payments->where('status', 'Belum Lunas')->count();

        $totalPaidAmount = $payments->where('status', 'Lunas')->sum('amount');
        $totalUnpaidAmount = $payments->where('status', 'Belum Lunas')->sum('amount');
    @endphp

    <!-- SPP Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Total Terbayar</p>
            <h3 class="text-3xl font-black text-emerald-600">Rp {{ number_format($totalPaidAmount, 0, ',', '.') }}</h3>
            <span class="text-xs font-semibold text-slate-400 mt-2 block">{{ $paidCount }} bulan lunas</span>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Sisa Tunggakan</p>
            <h3 class="text-3xl font-black text-rose-500">Rp {{ number_format($totalUnpaidAmount, 0, ',', '.') }}</h3>
            <span class="text-xs font-semibold text-slate-400 mt-2 block">{{ $unpaidCount }} bulan belum lunas</span>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm relative overflow-hidden">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Status Pembayaran</p>
            <div class="mt-2.5 flex items-center gap-2">
                <span class="text-2xl font-black text-slate-800">
                    {{ $totalBills > 0 ? round(($paidCount / $totalBills) * 100) : 100 }}%
                </span>
                <span class="text-xs text-slate-400 font-bold">Lunas Terpenuhi</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-2 mt-3.5">
                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $totalBills > 0 ? ($paidCount / $totalBills) * 100 : 100 }}%"></div>
            </div>
        </div>
    </div>

    <!-- SPP List Table -->
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100 bg-white">
            <h3 class="font-bold text-slate-800 text-[15px]">Daftar Tagihan SPP</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="py-4 px-6 font-bold text-slate-400 text-xs uppercase tracking-wider">Bulan Tagihan</th>
                        <th class="py-4 px-6 font-bold text-slate-400 text-xs uppercase tracking-wider">Nominal SPP</th>
                        <th class="py-4 px-6 font-bold text-slate-400 text-xs uppercase tracking-wider">Status</th>
                        <th class="py-4 px-6 font-bold text-slate-400 text-xs uppercase tracking-wider">Tanggal Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 divide-y divide-slate-50">
                    @forelse($payments as $p)
                        <tr class="hover:bg-slate-50/40 transition-colors">
                            <td class="py-4 px-6 font-bold text-slate-800">
                                {{ $monthsIndo[$p->month] ?? $p->month }} {{ $p->year }}
                            </td>
                            <td class="py-4 px-6 font-medium text-slate-700">Rp {{ number_format($p->amount, 0, ',', '.') }}</td>
                            <td class="py-4 px-6">
                                @if($p->status === 'Lunas')
                                    <span class="bg-emerald-50 text-emerald-500 border border-emerald-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase">Lunas</span>
                                @else
                                    <span class="bg-rose-50 text-rose-500 border border-rose-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase">Belum Lunas</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-slate-500 font-medium">
                                {{ $p->payment_date ? \Carbon\Carbon::parse($p->payment_date)->translatedFormat('d F Y, H:i') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-slate-400">Tidak ada riwayat tagihan SPP.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
