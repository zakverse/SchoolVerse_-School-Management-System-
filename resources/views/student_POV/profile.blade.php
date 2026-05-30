@extends('layout.student.sidebar')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="mb-6">
        <h2 class="text-2xl font-black text-slate-800 leading-tight">Profil & Keamanan</h2>
        <p class="text-slate-500 text-sm mt-1">Kelola data diri Anda dan keamanan kata sandi.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-600 rounded-xl text-sm font-medium">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Biodata Card -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm">
                <h3 class="font-bold text-slate-800 text-[15px] mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Biodata Siswa
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Lengkap</span>
                        <p class="text-sm font-bold text-slate-800">{{ $student->name }}</p>
                    </div>

                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nomor Induk Siswa (NIS)</span>
                        <p class="text-sm font-bold text-slate-800">{{ $student->nis }}</p>
                    </div>

                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kelas Akademik</span>
                        <p class="text-sm font-bold text-slate-800">{{ $student->class }}</p>
                    </div>

                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Kelamin</span>
                        <p class="text-sm font-bold text-slate-800">{{ $student->gender }}</p>
                    </div>

                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Email Akun</span>
                        <p class="text-sm font-medium text-slate-600">{{ $student->user->email ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status Siswa</span>
                        <div>
                            @if($student->status === 'active')
                                <span class="bg-emerald-50 text-emerald-500 border border-emerald-100 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">Aktif</span>
                            @else
                                <span class="bg-gray-100 text-gray-400 border border-gray-200 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">Nonaktif</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Change Password Card -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm">
                <h3 class="font-bold text-slate-800 text-[15px] mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Ubah Kata Sandi
                </h3>

                <form action="{{ route('student.profile.password') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1.5">Password Lama</label>
                        <input type="password" name="old_password" required placeholder="••••••••" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1.5">Password Baru</label>
                        <input type="password" name="password" required placeholder="Minimal 8 karakter..." class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1.5">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <button type="submit" class="w-full bg-[#2563eb] hover:bg-blue-700 text-white py-2.5 rounded-xl font-bold transition-all shadow-md shadow-blue-100 mt-2 text-sm">
                        Perbarui Password
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
