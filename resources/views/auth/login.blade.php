<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - EduManage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md bg-white p-10 rounded-none border border-slate-200 shadow-2xl shadow-slate-200/50">
        
        <div class="flex items-center gap-3 mb-10 pb-6 border-b border-slate-100">
            <div class="bg-blue-600 p-2 rounded-none shadow-lg shadow-blue-100">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                </svg>
            </div>
            <span class="text-2xl font-black tracking-tighter text-slate-900">EduManage</span>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Login ke Sistem</h2>
            <p class="text-slate-400 text-sm mt-1.5 font-medium italic">Silakan masukkan akun Admin Anda.</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Email / Username</label>
                <div class="relative">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <input type="text" name="login" required 
                        class="w-full border border-slate-200 rounded-none pl-12 pr-4 py-3.5 text-sm outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all font-medium text-slate-700 placeholder:text-slate-300" 
                        placeholder="admin@edumanage.com">
                </div>
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center px-1">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Kata Sandi</label>
                    <a href="#" class="text-[10px] font-bold text-blue-600 hover:underline uppercase tracking-wider">Lupa?</a>
                </div>
                <div class="relative">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input type="password" name="password" required 
                        class="w-full border border-slate-200 rounded-none pl-12 pr-4 py-3.5 text-sm outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all font-medium text-slate-700 placeholder:text-slate-300" 
                        placeholder="••••••••">
                </div>
            </div>

            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox" name="remember" class="w-4 h-4 border border-slate-300 rounded-none text-blue-600 focus:ring-blue-600 cursor-pointer">
                <span class="text-sm font-semibold text-slate-500 group-hover:text-slate-900 transition-colors">Ingat saya</span>
            </label>

            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold py-4 rounded-none transition-all text-sm uppercase tracking-[0.2em] shadow-lg shadow-blue-100">
                Masuk Sekarang
            </button>
        </form>

        <p class="text-center mt-12 text-slate-300 text-[10px] font-bold uppercase tracking-widest">
            © 2026 EduManage Team
        </p>
    </div>

</body>
</html>