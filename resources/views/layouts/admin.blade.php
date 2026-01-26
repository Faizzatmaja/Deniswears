<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

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
    </style>
</head>

<body class="bg-black antialiased">

<div class="min-h-screen flex flex-col">

    {{-- HEADER / NAVBAR --}}
    <header class="bg-black border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-20">
                
                {{-- Logo & Navigation --}}
                <div class="flex items-center gap-8">
                    {{-- Logo --}}
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                        <span class="text-3xl font-black text-white impact-font tracking-tight">DENISWEARS</span>
                        <span class="px-2 py-1 bg-red-500 text-white text-xs font-bold rounded uppercase tracking-wide">Admin</span>
                    </a>

                    {{-- Desktop Navigation --}}
                    <nav class="hidden md:flex items-center gap-6">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="text-sm font-semibold uppercase tracking-wide transition {{ request()->routeIs('admin.dashboard') ? 'text-red-500' : 'text-white hover:text-red-500' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.products.index') }}" 
                           class="text-sm font-semibold uppercase tracking-wide transition {{ request()->routeIs('admin.products.*') ? 'text-red-500' : 'text-white hover:text-red-500' }}">
                            Produk
                        </a>
                    </nav>
                </div>

                {{-- Right Actions --}}
                <div class="flex items-center gap-4">
                    {{-- User Info (Desktop) --}}
                    <div class="hidden md:flex items-center gap-2 text-white">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-semibold uppercase tracking-wide">{{ auth()->user()->name }}</span>
                    </div>

                    {{-- Logout Button (Desktop) --}}
                    <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-semibold text-white hover:text-red-500 transition uppercase tracking-wide">
                            Logout
                        </button>
                    </form>

                    {{-- Mobile Menu Button --}}
                    <button id="mobile-menu-btn" class="md:hidden p-2 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-800 bg-black">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-4 py-3 text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('admin.dashboard') ? 'text-red-500' : 'text-white' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" 
                   class="block px-4 py-3 text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('admin.products.*') ? 'text-red-500' : 'text-white' }}">
                    Produk
                </a>
                <div class="flex items-center gap-2 px-4 py-3 border-t border-gray-800 text-white">
                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <span class="text-sm font-semibold uppercase tracking-wide">{{ auth()->user()->name }}</span>
                </div>
                <div class="pt-3 border-t border-gray-800">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 text-sm font-semibold text-red-500 uppercase tracking-wide">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="flex-1 py-8">
        <div class="max-w-7xl mx-auto px-6">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-black border-t border-gray-800 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500">&copy; 2024 Deniswears Admin Panel. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="text-gray-400 hover:text-white transition text-sm uppercase tracking-wide">Support</a>
                    <a href="#" class="text-gray-400 hover:text-white transition text-sm uppercase tracking-wide">Documentation</a>
                </div>
            </div>
        </div>
    </footer>

</div>

<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuBtn?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>

</body>
</html>