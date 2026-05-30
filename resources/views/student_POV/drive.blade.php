@extends('layout.student.sidebar')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="mb-6">
        <h2 class="text-2xl font-black text-slate-800 leading-tight">Photo Vault</h2>
        <p class="text-slate-500 text-sm mt-1">Penyimpanan galeri foto pribadi Anda untuk tugas, praktikum, atau catatan.</p>
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

    <!-- Upload Card -->
    <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm mb-8">
        <h3 class="font-bold text-slate-800 text-[15px] mb-4">Unggah Foto Baru</h3>
        
        <form action="{{ route('student.drive.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="border-2 border-dashed border-slate-200 rounded-2xl p-8 text-center hover:border-blue-500 hover:bg-blue-50/10 transition-all cursor-pointer relative group">
                <input type="file" name="photo" required accept="image/*" onchange="this.form.submit()" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div class="flex flex-col items-center justify-center space-y-2">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700">Tarik & lepas file foto Anda di sini, atau klik untuk memilih</p>
                    <p class="text-xs text-slate-400">Mendukung JPEG, PNG, JPG, GIF, WEBP (Maksimal 5MB)</p>
                </div>
            </div>
        </form>
    </div>

    <!-- Photo Gallery Grid -->
    <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm">
        <h3 class="font-bold text-slate-800 text-[15px] mb-6">Semua Foto ({{ $files->total() }})</h3>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($files as $file)
                @php
                    $fileSizeFormatted = $file->file_size >= 1048576 
                        ? round($file->file_size / 1048576, 1) . ' MB' 
                        : round($file->file_size / 1024) . ' KB';
                    $assetUrl = asset('storage/' . $file->file_path);
                @endphp
                <div class="bg-slate-50 border border-slate-200/60 rounded-2xl overflow-hidden group hover:shadow-md hover:border-slate-300 transition-all flex flex-col justify-between">
                    <div class="relative aspect-square bg-slate-100 flex items-center justify-center overflow-hidden cursor-pointer" onclick="openLightbox('{{ $assetUrl }}', '{{ addslashes($file->title) }}')">
                        <img src="{{ $assetUrl }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $file->title }}">
                        <div class="absolute inset-0 bg-slate-900/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="bg-white/95 text-slate-800 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">Pratinjau</span>
                        </div>
                    </div>
                    <div class="p-4 bg-white border-t border-slate-100">
                        <h4 class="font-bold text-slate-800 text-xs truncate" title="{{ $file->title }}">{{ $file->title }}</h4>
                        <div class="flex justify-between items-center mt-2.5">
                            <span class="text-[10px] text-slate-400 font-bold uppercase">{{ $fileSizeFormatted }}</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ $assetUrl }}" download="{{ $file->title }}" class="p-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all" title="Unduh">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </a>
                                <form action="{{ route('student.drive.delete', $file->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-rose-50 text-rose-500 rounded-lg hover:bg-rose-600 hover:text-white transition-all" title="Hapus">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 bg-slate-50 rounded-2xl py-12 text-center text-slate-400 font-bold border border-dashed border-slate-200">
                    Vault Anda masih kosong. Mulai unggah foto pertama Anda!
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $files->links() }}
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-[100] bg-slate-950/80 backdrop-blur-md hidden flex items-center justify-center p-4" onclick="closeLightbox()">
    <div class="relative max-w-4xl max-h-[85vh] flex flex-col items-center bg-white rounded-2xl overflow-hidden shadow-2xl p-3" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 bg-slate-900/60 hover:bg-slate-900 text-white rounded-full p-2 transition-colors z-50">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <img id="lightbox-img" src="" class="max-w-full max-h-[75vh] object-contain rounded-xl" alt="Lightbox Preview">
        <div class="py-3 px-4 w-full text-center">
            <h4 id="lightbox-title" class="font-bold text-slate-800 text-sm truncate">Preview</h4>
        </div>
    </div>
</div>

<script>
    function openLightbox(src, title) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-title').innerText = title;
        document.getElementById('lightbox').classList.remove('hidden');
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
    }
</script>
@endsection
