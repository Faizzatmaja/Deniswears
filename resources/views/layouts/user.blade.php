<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Deniswears')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        @keyframes pulse-border {
            0%, 100% {
                border-color: rgb(239, 68, 68);
            }
            50% {
                border-color: rgb(220, 38, 38);
            }
        }

        .search-highlight {
            animation: pulse-border 1.5s ease-in-out 3;
        }
    </style>
</head>
<body class="bg-black antialiased">

    {{-- Navbar --}}
    <nav class="bg-black border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                
                {{-- Logo --}}
                <a href="{{ route('user.home') }}" class="flex items-center gap-3 group -ml-2">
                    <span class="text-3xl font-black text-white impact-font tracking-tight">DENISWEARS</span>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-6 ml-12">
                    <a href="{{ route('user.home') }}" 
                       class="text-sm font-semibold uppercase tracking-wide transition {{ request()->routeIs('user.home') ? 'text-red-500' : 'text-white hover:text-red-500' }}">
                        Home
                    </a>
                    <a href="{{ route('user.cart') }}" 
                       class="text-sm font-semibold uppercase tracking-wide transition {{ request()->routeIs('user.cart') ? 'text-red-500' : 'text-white hover:text-red-500' }}">
                        Cart
                    </a>
                    <a href="{{ route('user.orders') }}" 
                       class="text-sm font-semibold uppercase tracking-wide transition {{ request()->routeIs('user.orders') ? 'text-red-500' : 'text-white hover:text-red-500' }}">
                        Pesanan
                    </a>
                    <a href="{{ route('user.about') }}"
                       class="text-sm font-semibold uppercase tracking-wide transition {{ request()->routeIs('user.about') ? 'text-red-500' : 'text-white hover:text-red-500' }}">
                        About
                    </a>
                </div>

                {{-- Search Bar --}}
                <div class="hidden lg:flex items-center flex-1 max-w-md mx-8">
                    <form action="{{ route('user.home') }}" method="GET" class="w-full relative" id="desktop-search-form">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari produk..."
                               class="w-full bg-gray-900 border-2 border-gray-800 rounded-full pl-4 pr-12 py-2 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-red-500 transition duration-300">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center hover:bg-red-600 transition">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- Right Actions --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('user.profile') }}" 
                       class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white hover:text-red-500 transition">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <span class="hidden lg:inline uppercase tracking-wide">{{ auth()->user()->name }}</span>
                    </a>

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
                {{-- Mobile Search --}}
                <div class="py-3">
                    <form action="{{ route('user.home') }}" method="GET" class="relative" id="mobile-search-form">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari produk..."
                               class="w-full bg-gray-900 border-2 border-gray-800 rounded-full pl-4 pr-12 py-3 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-red-500 transition duration-300">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <a href="{{ route('user.home') }}" 
                   class="block px-4 py-3 text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('user.home') ? 'text-red-500' : 'text-white' }}">
                    Home
                </a>
                <a href="{{ route('user.cart') }}" 
                   class="block px-4 py-3 text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('user.cart') ? 'text-red-500' : 'text-white' }}">
                    Cart
                </a>
                <a href="{{ route('user.orders') }}" 
                   class="block px-4 py-3 text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('user.orders') ? 'text-red-500' : 'text-white' }}">
                    Pesanan
                </a>
                <a href="{{ route('user.about') }}"
                   class="block px-4 py-3 text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('user.about') ? 'text-red-500' : 'text-white' }}">
                    About
                </a>
                <a href="{{ route('user.profile') }}" 
                   class="block px-4 py-3 text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('user.profile') ? 'text-red-500' : 'text-white' }}">
                    Profile
                </a>
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
    </nav>

    {{-- Content --}}
    <main>
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="max-w-7xl mx-auto px-6 pt-6">
            <div class="bg-green-500/10 border-2 border-green-500 rounded-xl p-4 flex items-center justify-between gap-3 animate-fade-in">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-green-500 font-bold">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="max-w-7xl mx-auto px-6 pt-6">
            <div class="bg-red-500/10 border-2 border-red-500 rounded-xl p-4 flex items-center justify-between gap-3 animate-fade-in">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-red-500 font-bold">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        @if(session('info'))
        <div class="max-w-7xl mx-auto px-6 pt-6">
            <div class="bg-blue-500/10 border-2 border-blue-500 rounded-xl p-4 flex items-center justify-between gap-3 animate-fade-in">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-blue-500 font-bold">{{ session('info') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-blue-500 hover:text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-black text-gray-400 border-t border-gray-800 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <span class="text-2xl font-black text-white impact-font tracking-tight mb-4 block">DENISWEARS</span>
                    <p class="text-sm leading-relaxed max-w-md text-gray-400">
                        Your trusted destination for premium fashion and accessories. Quality products with modern style.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase tracking-wide text-sm">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Products</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase tracking-wide text-sm">Support</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Shipping</a></li>
                        <li><a href="#" class="hover:text-white transition">Returns</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500">&copy; 2024 Deniswears. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="text-gray-400 hover:text-white transition text-sm">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition text-sm">Terms</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuBtn?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // flash messages 
    setTimeout(() => {
        const flashMessages = document.querySelectorAll('.animate-fade-in');
        flashMessages.forEach(msg => {
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(-10px)';
            msg.style.transition = 'all 0.3s ease-out';
            setTimeout(() => msg.remove(), 300);
        });
    }, 5000);

    // Auto scroll to products when search is used
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const searchQuery = urlParams.get('search');
        const categoryQuery = urlParams.get('category');
        
        if ((searchQuery && searchQuery.trim() !== '') || categoryQuery) {
            setTimeout(() => {
                const koleksiSection = document.getElementById('koleksi');
                
                if (koleksiSection) {
                    koleksiSection.scrollIntoView({ 
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }, 300);
        }
    });
</script>
</body>
</html>