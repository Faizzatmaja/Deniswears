<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Deniswears</title>
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

        .animated-bg {
            background: linear-gradient(135deg, #000000 0%, #1a0000 50%, #000000 100%);
            background-size: 200% 200%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .glow-effect {
            box-shadow: 0 0 40px rgba(239, 68, 68, 0.3);
        }

        .input-glow:focus {
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.4);
        }
    </style>
</head>

<body class="min-h-screen animated-bg flex items-center justify-center p-4">

    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden glow-effect">

        {{-- LEFT SIDE - BRANDING WITH IMAGE --}}
        <div class="relative bg-black p-12 flex flex-col justify-between overflow-hidden">

            {{-- Background Image --}}
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1529139574466-a303027c1d8b?w=800" alt="Fashion Model"
                    class="w-full h-full object-cover opacity-60">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
            </div>

            {{-- Logo & Text Content --}}
            <div class="relative z-10">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="Denis Wears Logo" 
                     class="w-[400px] h-auto mb-6 drop-shadow-2xl">
                <p class="text-white/90 text-lg font-semibold uppercase tracking-[0.3em] drop-shadow-lg">Premium Fashion
                    Collection</p>
            </div>

            {{-- Bottom Quote --}}
            <div class="relative z-10">
                <div class="border-l-4 border-white pl-4">
                    <p class="text-white text-xl md:text-2xl font-black italic leading-tight mb-2">
                        "Style is a way to say who you are without having to speak"
                    </p>
                    <p class="text-white/60 text-sm uppercase tracking-wider font-semibold">— DENISWEARS</p>
                </div>
            </div>

            {{-- Decorative Elements --}}
            <div class="absolute top-1/4 right-8 w-2 h-32 bg-white/20 rounded-full"></div>
            <div class="absolute bottom-1/4 right-12 w-2 h-24 bg-white/10 rounded-full"></div>
        </div>

        {{-- RIGHT SIDE - FORM --}}
        <div class="bg-black p-8 lg:p-12 flex flex-col justify-center">

            {{-- Header --}}
            <div class="mb-8">
                <h2 class="text-4xl md:text-5xl font-black text-white impact-font mb-3 leading-none">
                    MASUK
                </h2>
                <p class="text-gray-400 text-sm uppercase tracking-wide font-semibold">
                    Selamat datang kembali!
                </p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">Email
                        Address</label>
                    <input type="email" name="email" required placeholder="nama@email.com" class="w-full bg-gray-900 border-2 border-gray-800 rounded-xl px-4 py-4
                               text-sm text-white placeholder-gray-600
                               focus:outline-none focus:border-red-500 input-glow
                               transition duration-300">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required placeholder="••••••••" class="w-full bg-gray-900 border-2 border-gray-800 rounded-xl px-4 py-4 pr-12
                               text-sm text-white placeholder-gray-600
                               focus:outline-none focus:border-red-500 input-glow
                               transition duration-300">
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500 transition duration-300">
                            <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Options --}}
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-2 border-gray-800 bg-gray-900 text-red-500
                                      focus:ring-2 focus:ring-red-500 focus:ring-offset-0 focus:ring-offset-black">
                        <span
                            class="text-gray-400 font-semibold uppercase tracking-wide group-hover:text-white transition">Ingat
                            Saya</span>
                    </label>

                    <a href="#" class="text-red-500 hover:text-red-400 transition font-bold uppercase tracking-wide">
                        Lupa Password?
                    </a>
                </div>

                {{-- Login Button --}}
                <button type="submit" class="w-full py-4 rounded-xl font-black text-white uppercase tracking-wider
                           bg-red-500 hover:bg-red-600
                           shadow-lg shadow-red-500/50 hover:shadow-red-500/70
                           transition-all duration-300 text-sm
                           border-2 border-red-500 hover:border-red-400
                           transform hover:scale-[1.02]">
                    Masuk Sekarang
                </button>

                {{-- Divider --}}
                <div class="flex items-center gap-4 my-6">
                    <span class="flex-1 h-px bg-gray-800"></span>
                    <span class="text-xs text-gray-600 font-bold uppercase tracking-wider">Atau</span>
                    <span class="flex-1 h-px bg-gray-800"></span>
                </div>

                {{-- Google Login --}}
                <button type="button" class="w-full border-2 border-gray-800 rounded-xl py-4
                           flex items-center justify-center gap-3
                           hover:bg-gray-900 hover:border-gray-700 transition-all duration-300 text-sm
                           font-bold uppercase tracking-wide text-gray-400 hover:text-white
                           transform hover:scale-[1.02]">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#EA4335"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#4285F4"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Masuk dengan Google
                </button>
            </form>

            {{-- Footer --}}
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="text-red-500 hover:text-red-400 font-bold uppercase tracking-wide transition">
                        Daftar Sekarang
                    </a>
                </p>
            </div>

            {{-- Copyright --}}
            <div class="mt-8 pt-8 border-t border-gray-900 text-center">
                <p class="text-xs text-gray-600 uppercase tracking-wider">
                    &copy; 2024 Deniswears. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>

</body>

</html>