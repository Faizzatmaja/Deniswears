<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar | Deniswears</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .impact-font {
            font-family: Impact, 'Arial Black', sans-serif;
            letter-spacing: -0.02em;
        }

        .diagonal-bg {
            background: linear-gradient(135deg, #000000 0%, #1a0000 50%, #000000 100%);
        }

        .password-input-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #fff;
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body class="min-h-screen diagonal-bg">

    {{-- TOP NAVIGATION --}}
    <div class="absolute top-0 left-0 right-0 z-50 p-4 md:p-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <span class="text-white font-black text-4xl impact-font">DENISWEARS</span>
        </div>
        <a href="{{ route('login') }}" class="text-white/80 hover:text-white text-lg font-semibold transition">
            ← Login
        </a>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4 pt-20">
        
        <div class="w-full max-w-2xl">
            
            {{-- HERO SECTION --}}
            <div class="text-center mb-8">
                <span class="bg-red-500/10 border border-red-500/30 text-red-400 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide inline-block mb-3">
                    Join 10,000+ Members
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-white impact-font mb-2 leading-tight">
                    BUAT AKUN BARU
                </h1>
                <p class="text-gray-400 text-sm">
                    Bergabung dan dapatkan akses eksklusif
                </p>
            </div>

            {{-- MAIN FORM CARD --}}
            <div class="bg-black/60 backdrop-blur-xl border border-gray-800 rounded-2xl p-6 md:p-8">
                
                {{-- FORM --}}
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wide">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" required
                            placeholder="Masukkan nama lengkap"
                            value="{{ old('name') }}"
                            class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-3
                                   text-white placeholder-gray-600
                                   focus:outline-none focus:border-red-500
                                   transition duration-300">
                        @error('name')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wide">
                            Email
                        </label>
                        <input type="email" name="email" required
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-3
                                   text-white placeholder-gray-600
                                   focus:outline-none focus:border-red-500
                                   transition duration-300">
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wide">
                            Password
                        </label>
                        <div class="password-input-wrapper">
                            <input type="password" name="password" id="password" required
                                placeholder="Min. 8 karakter"
                                class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-3 pr-12
                                       text-white placeholder-gray-600
                                       focus:outline-none focus:border-red-500
                                       transition duration-300">
                            <button type="button" class="toggle-password" onclick="togglePassword('password', 'eyeIcon1')">
                                <svg id="eyeIcon1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Confirmation --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wide">
                            Konfirmasi Password
                        </label>
                        <div class="password-input-wrapper">
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                placeholder="Ulangi password"
                                class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-3 pr-12
                                       text-white placeholder-gray-600
                                       focus:outline-none focus:border-red-500
                                       transition duration-300">
                            <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                                <svg id="eyeIcon2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="flex items-start gap-2 pt-2">
                        <input type="checkbox" name="terms" required
                               class="w-4 h-4 mt-0.5 rounded border-2 border-gray-700 bg-gray-900 text-red-500
                                      focus:ring-2 focus:ring-red-500 focus:ring-offset-0">
                        <label class="text-xs text-gray-400">
                            Saya setuju dengan 
                            <a href="#" class="text-red-500 hover:text-red-400 font-semibold">Syarat & Ketentuan</a>
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="w-full py-3.5 rounded-xl font-bold text-white uppercase tracking-wide
                               bg-red-500 hover:bg-red-600
                               shadow-lg hover:shadow-xl
                               transition-all duration-300 text-sm
                               transform hover:scale-[1.01]">
                        Daftar Sekarang
                    </button>

                    {{-- Divider --}}
                    <div class="flex items-center gap-3 my-5">
                        <span class="flex-1 h-px bg-gray-800"></span>
                        <span class="text-xs text-gray-600 font-semibold">ATAU</span>
                        <span class="flex-1 h-px bg-gray-800"></span>
                    </div>

                    {{-- Google Register --}}
                    <button type="button"
                        class="w-full border border-gray-800 rounded-xl py-3
                               flex items-center justify-center gap-2
                               hover:bg-gray-900 hover:border-gray-700 transition-all duration-300
                               font-semibold text-gray-400 hover:text-white text-sm">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#EA4335" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#4285F4" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Daftar dengan Google
                    </button>
                </form>

                {{-- Footer Link --}}
                <div class="mt-6 text-center">
                    <p class="text-xs text-gray-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-red-500 hover:text-red-400 font-semibold">
                            Masuk
                        </a>
                    </p>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="text-center mt-6 text-gray-700 text-xs">
                <p>&copy; 2024 Deniswears. All Rights Reserved.</p>
            </div>

        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                // Change to eye-off icon
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                `;
            } else {
                input.type = 'password';
                // Change back to eye icon
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        }
    </script>

</body>
</html>