@extends('layouts.user')

@section('title', 'Deniswears - Home')

@section('content')
{{-- Hero Section --}}
<div class="relative overflow-hidden" style="min-height: 600px;">
    {{-- Subtle Background Elements --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-white rounded-full blur-3xl"></div>
    </div>
    
    {{-- Content Container --}}
    <div class="relative max-w-7xl mx-auto px-6 py-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            {{-- Text Content --}}
            <div>
                <img src="{{ asset('images/logo.png') }}" 
                     alt="Denis Wears Logo" 
                     class="w-[500px] h-auto mb-6 drop-shadow-2xl">
                <p class="text-2xl font-bold text-white mb-2 drop-shadow-md">
                    PREMIUM FASHION
                </p>
                <p class="text-gray-100 mb-8 max-w-md drop-shadow-md">
                    "Temukan gaya terbaik Anda dengan koleksi fashion premium kami yang stylish dan berkualitas tinggi."
                </p>
                <button onclick="scrollToCollection()" 
                        class="bg-red-500 hover:bg-red-600 text-white font-bold px-8 py-3 rounded-full text-lg transition duration-300 shadow-lg hover:shadow-xl">
                    Lihat Koleksi
                </button>
            </div>
                    
            {{-- Images Container --}}
            <div class="relative flex gap-6 items-center justify-center">
                {{-- Foto 1 --}}
                <div class="relative h-[32rem] flex items-center justify-center overflow-visible">
                    <img src="{{ asset('images/foto.png') }}"
                         alt="Streetwear Fashion"
                         class="relative z-10 w-[22rem] h-[28rem] object-cover rounded-3xl"
                         style="transform: scale(1.3); transform-origin: center;">
                </div>
                
                {{-- Foto 2 --}}
                <div class="relative h-[32rem] flex items-center justify-center overflow-visible">
                    <img src="{{ asset('images/foto2.png') }}"
                         alt="Urban Style Fashion"
                         class="relative z-10 w-[22rem] h-[28rem] object-cover rounded-3xl"
                         style="transform: scale(1.3); transform-origin: center;">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filter Section --}}
<div class="bg-gradient-to-b from-gray-900 to-black border-b-2 border-gray-800 py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-8">
            <h2 class="text-5xl md:text-6xl font-black text-white" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
                SEMUA PRODUK
            </h2>
        </div>

        {{-- Category Pills --}}
        <div class="flex flex-wrap gap-3 mb-8">
            <a href="{{ route('user.home') }}" 
               class="px-6 py-3 rounded-full font-bold transition {{ !request('category') ? 'bg-red-500 text-white' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}">
                Semua
            </a>
            <a href="{{ route('user.home', ['category' => 'kaos']) }}" 
               class="px-6 py-3 rounded-full font-bold transition {{ request('category') == 'kaos' ? 'bg-red-500 text-white' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}">
                Kaos
            </a>
            <a href="{{ route('user.home', ['category' => 'jaket']) }}" 
               class="px-6 py-3 rounded-full font-bold transition {{ request('category') == 'jaket' ? 'bg-red-500 text-white' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}">
                Jaket
            </a>
            <a href="{{ route('user.home', ['category' => 'celana']) }}" 
               class="px-6 py-3 rounded-full font-bold transition {{ request('category') == 'celana' ? 'bg-red-500 text-white' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}">
                Celana
            </a>
            <a href="{{ route('user.home', ['category' => 'aksesoris']) }}" 
               class="px-6 py-3 rounded-full font-bold transition {{ request('category') == 'aksesoris' ? 'bg-red-500 text-white' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}">
                Aksesoris
            </a>
        </div>

        {{-- Products Count & Search Info --}}
        <div class="flex items-center justify-between mb-6">
            <p class="text-gray-400">
                Menampilkan <span class="text-white font-bold">{{ $products->count() }}</span> dari <span class="text-white font-bold">{{ $totalProducts }}</span> produk
            </p>
            @if(request('search'))
            <div class="flex items-center gap-2">
                <span class="text-gray-400 text-sm">Pencarian:</span>
                <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-bold flex items-center gap-2">
                    "{{ request('search') }}"
                    <a href="{{ route('user.home') }}" class="hover:text-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </span>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- All Products Section --}}
<div id="koleksi" class="bg-black py-16">
    <div class="max-w-7xl mx-auto px-6">
        @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="group cursor-pointer bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:shadow-red-500/20 transition-all duration-300 border border-gray-800 hover:border-red-500">
                {{-- Product Image --}}
                <div class="relative h-80 bg-gray-800 overflow-hidden" onclick="openDetailModal({{ $product->id }})">
                    <img src="{{ $product->gambar ? asset('storage/' . $product->gambar) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=400' }}" 
                         alt="{{ $product->nama_produk }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    
                    {{-- Badges --}}
                    @if($product->stok <= 5 && $product->stok > 0)
                    <div class="absolute top-4 right-4 bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                        Stok Terbatas
                    </div>
                    @elseif($product->stok == 0)
                    <div class="absolute inset-0 bg-black/90 flex items-center justify-center">
                        <p class="text-white font-bold text-lg">SOLD OUT</p>
                    </div>
                    @endif

                    @if(isset($product->harga_diskon) && $product->harga_diskon)
                    <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                        SALE
                    </div>
                    @endif
                </div>

                {{-- Product Info --}}
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-1 line-clamp-1 text-white">{{ $product->nama_produk }}</h3>
                    <p class="text-gray-400 text-sm mb-3">{{ $product->kategori->nama_kategori ?? 'Uncategorized' }}</p>
                    
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            @if(isset($product->harga_diskon) && $product->harga_diskon)
                            <p class="text-lg font-bold text-red-500">Rp {{ number_format($product->harga_diskon, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 line-through">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            @else
                            <p class="text-lg font-bold text-white">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Action Buttons --}}
                    <div class="flex gap-2">
                        <button onclick="openDetailModal({{ $product->id }})" 
                                class="flex-1 bg-gray-800 hover:bg-gray-700 text-white py-2 px-3 rounded-lg transition text-sm font-bold border border-gray-700">
                            Lihat Detail
                        </button>
                        
                        @if($product->stok > 0)
                        <button onclick="event.stopPropagation(); openSizeModal({{ $product->id }}, '{{ addslashes($product->nama_produk) }}', {{ $product->stok }})" 
                                class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </button>
                        @else
                        <button disabled class="bg-gray-700 text-gray-500 p-2 rounded-lg cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 bg-gray-900 rounded-3xl shadow-lg border border-gray-800">
            <svg class="w-24 h-24 mx-auto mb-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-2xl font-bold text-white mb-2">Produk Tidak Ditemukan</h3>
            <p class="text-gray-400 mb-6">Maaf, tidak ada produk yang sesuai dengan pencarian Anda</p>
            <a href="{{ route('user.home') }}" class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold px-8 py-3 rounded-full transition">
                Lihat Semua Produk
            </a>
        </div>
        @endif
    </div>
</div>

{{-- Detail Product Modal --}}
<div id="detailModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-gray-900 rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto relative shadow-2xl border border-gray-800">
        {{-- Close Button --}}
        <button onclick="closeDetailModal()" class="absolute top-4 right-4 z-10 text-gray-400 hover:text-white transition bg-gray-800 rounded-full p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="grid md:grid-cols-2 gap-8 p-8">
            {{-- Product Image --}}
            <div class="relative">
                <img id="detailImage" src="" alt="" class="w-full h-96 object-cover rounded-2xl">
                <div id="detailBadges" class="absolute top-4 left-4"></div>
            </div>

            {{-- Product Info --}}
            <div>
                <p id="detailCategory" class="text-red-500 font-bold text-sm mb-2 uppercase"></p>
                <h2 id="detailName" class="text-3xl font-black text-white mb-4"></h2>
                
                <div id="detailPriceSection" class="mb-6">
                    <!-- Prices will be inserted here -->
                </div>

                <div class="bg-gray-800 rounded-xl p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400">Stok Tersedia</span>
                        <span id="detailStock" class="text-white font-bold text-xl"></span>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-white font-bold mb-3">Deskripsi Produk</h3>
                    <p id="detailDescription" class="text-gray-400 leading-relaxed"></p>
                </div>

                {{-- Size Selection in Detail --}}
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-300 mb-3 uppercase tracking-wide">Pilih Ukuran</label>
                    <div class="grid grid-cols-4 gap-3">
                        <button type="button" onclick="selectDetailSize('S')" data-detail-size="S" class="detail-size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                            S
                        </button>
                        <button type="button" onclick="selectDetailSize('M')" data-detail-size="M" class="detail-size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                            M
                        </button>
                        <button type="button" onclick="selectDetailSize('L')" data-detail-size="L" class="detail-size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                            L
                        </button>
                        <button type="button" onclick="selectDetailSize('XL')" data-detail-size="XL" class="detail-size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                            XL
                        </button>
                    </div>
                </div>

                {{-- Quantity Selection in Detail --}}
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-300 mb-3 uppercase tracking-wide">Jumlah</label>
                    <div class="flex items-center gap-4">
                        <button type="button" onclick="decreaseDetailQty()" class="w-12 h-12 bg-gray-800 hover:bg-gray-700 text-white font-black rounded-xl transition border border-gray-700">
                            -
                        </button>
                        <input type="number" id="detailQuantity" value="1" min="1" readonly
                               class="w-20 text-center bg-gray-800 border-2 border-gray-700 rounded-xl py-3 text-white font-black text-lg">
                        <button type="button" onclick="increaseDetailQty()" class="w-12 h-12 bg-gray-800 hover:bg-gray-700 text-white font-black rounded-xl transition border border-gray-700">
                            +
                        </button>
                    </div>
                </div>

                {{-- Add to Cart Button --}}
                <button id="detailAddToCart" onclick="addToCartFromDetail()" class="w-full bg-red-500 hover:bg-red-600 text-white font-black py-4 rounded-xl transition uppercase tracking-wide text-sm shadow-lg hover:shadow-xl">
                    Tambahkan ke Keranjang
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Size & Quantity Modal --}}
<div id="sizeModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-gray-900 rounded-2xl max-w-md w-full p-8 relative shadow-2xl border border-gray-800">
        {{-- Close Button --}}
        <button onclick="closeSizeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <h2 class="text-2xl font-black text-white mb-2 uppercase tracking-tight" id="modalProductName">Pilih Ukuran</h2>
        <p class="text-gray-400 text-sm mb-6">Pilih ukuran dan jumlah produk</p>

        <form id="addToCartForm" method="POST" action="">
            @csrf
            
            {{-- Size Selection --}}
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-300 mb-3 uppercase tracking-wide">Ukuran</label>
                <div class="grid grid-cols-4 gap-3">
                    <button type="button" onclick="selectSize('S')" data-size="S" class="size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                        S
                    </button>
                    <button type="button" onclick="selectSize('M')" data-size="M" class="size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                        M
                    </button>
                    <button type="button" onclick="selectSize('L')" data-size="L" class="size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                        L
                    </button>
                    <button type="button" onclick="selectSize('XL')" data-size="XL" class="size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                        XL
                    </button>
                </div>
                <input type="hidden" name="size" id="selectedSize" required>
            </div>

            {{-- Quantity Selection --}}
            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-300 mb-3 uppercase tracking-wide">Jumlah</label>
                <div class="flex items-center gap-4">
                    <button type="button" onclick="decreaseQty()" class="w-12 h-12 bg-gray-800 hover:bg-gray-700 text-white font-black rounded-xl transition border border-gray-700">
                        -
                    </button>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" readonly
                           class="w-20 text-center bg-gray-800 border-2 border-gray-700 rounded-xl py-3 text-white font-black text-lg">
                    <button type="button" onclick="increaseQty()" class="w-12 h-12 bg-gray-800 hover:bg-gray-700 text-white font-black rounded-xl transition border border-gray-700">
                        +
                    </button>
                    <span class="text-gray-400 text-sm">
                        Stok: <span id="maxStock" class="text-white font-bold">0</span>
                    </span>
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-black py-4 rounded-xl transition uppercase tracking-wide text-sm shadow-lg hover:shadow-xl">
                Tambahkan ke Keranjang
            </button>
        </form>
    </div>
</div>

{{-- Footer Navigation --}}
<div class="bg-black text-white border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <h3 class="font-bold text-lg mb-4">COLLECTIONS</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('user.home', ['category' => 'kaos']) }}" class="hover:text-white transition">Kaos</a></li>
                    <li><a href="{{ route('user.home', ['category' => 'jaket']) }}" class="hover:text-white transition">Jaket</a></li>
                    <li><a href="{{ route('user.home', ['category' => 'celana']) }}" class="hover:text-white transition">Celana</a></li>
                    <li><a href="{{ route('user.home', ['category' => 'aksesoris']) }}" class="hover:text-white transition">Aksesoris</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-lg mb-4">CATEGORY</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Men</a></li>
                    <li><a href="#" class="hover:text-white transition">Women</a></li>
                    <li><a href="#" class="hover:text-white transition">Unisex</a></li>
                    <li><a href="#" class="hover:text-white transition">Accessories</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-lg mb-4">STYLE</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Minimalist</a></li>
                    <li><a href="#" class="hover:text-white transition">Vintage</a></li>
                    <li><a href="#" class="hover:text-white transition">Modern</a></li>
                    <li><a href="#" class="hover:text-white transition">Urban</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-lg mb-4">CONTACT</h3>
                <button class="bg-red-500 hover:bg-red-600 text-white font-bold px-6 py-2 rounded-full transition w-full mb-4">
                    Hubungi Kami
                </button>
                <p class="text-gray-400 text-sm">Email: info@deniswears.com</p>
            </div>
        </div>
    </div>
</div>

<script>
    let maxStock = 0;
    let currentProductId = 0;
    let currentDetailProduct = null;

    // Scroll to Collection Section
    function scrollToCollection() {
        const koleksiSection = document.getElementById('koleksi');
        if (koleksiSection) {
            koleksiSection.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    // ============================================
    // DETAIL MODAL FUNCTIONS
    // ============================================
    
    function openDetailModal(productId) {
        fetch(`/user/product/${productId}`)
            .then(response => response.json())
            .then(product => {
                currentDetailProduct = product;
                
                // Update modal content
                document.getElementById('detailImage').src = product.gambar ? `/storage/${product.gambar}` : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=400';
                document.getElementById('detailImage').alt = product.nama_produk;
                document.getElementById('detailName').textContent = product.nama_produk;
                document.getElementById('detailCategory').textContent = product.kategori?.nama_kategori || 'Uncategorized';
                document.getElementById('detailStock').textContent = product.stok;
                document.getElementById('detailDescription').textContent = product.deskripsi || 'Produk fashion berkualitas tinggi dengan desain trendy dan nyaman dipakai. Material premium yang tahan lama dan cocok untuk berbagai kesempatan.';
                document.getElementById('detailQuantity').max = product.stok;
                document.getElementById('detailQuantity').value = 1;
                
                // Update price section
                let priceHTML = '';
                if (product.harga_diskon) {
                    priceHTML = `
                        <div class="flex items-baseline gap-3">
                            <p class="text-3xl font-black text-red-500">Rp ${formatNumber(product.harga_diskon)}</p>
                            <p class="text-lg text-gray-500 line-through">Rp ${formatNumber(product.harga)}</p>
                        </div>
                        <div class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold mt-2">
                            Hemat Rp ${formatNumber(product.harga - product.harga_diskon)}
                        </div>
                    `;
                } else {
                    priceHTML = `<p class="text-3xl font-black text-white">Rp ${formatNumber(product.harga)}</p>`;
                }
                document.getElementById('detailPriceSection').innerHTML = priceHTML;
                
                // Update badges
                let badgesHTML = '';
                if (product.stok <= 5 && product.stok > 0) {
                    badgesHTML += '<div class="bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-bold shadow-lg mb-2">Stok Terbatas</div>';
                }
                if (product.harga_diskon) {
                    badgesHTML += '<div class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">SALE</div>';
                }
                document.getElementById('detailBadges').innerHTML = badgesHTML;
                
                // Reset size selection
                document.querySelectorAll('.detail-size-btn').forEach(btn => {
                    btn.classList.remove('border-red-500', 'bg-red-500/20');
                    btn.classList.add('border-gray-700');
                });
                
                // Show/hide add to cart button based on stock
                const addToCartBtn = document.getElementById('detailAddToCart');
                if (product.stok > 0) {
                    addToCartBtn.disabled = false;
                    addToCartBtn.classList.remove('bg-gray-700', 'cursor-not-allowed');
                    addToCartBtn.classList.add('bg-red-500', 'hover:bg-red-600');
                    addToCartBtn.textContent = 'Tambahkan ke Keranjang';
                } else {
                    addToCartBtn.disabled = true;
                    addToCartBtn.classList.add('bg-gray-700', 'cursor-not-allowed');
                    addToCartBtn.classList.remove('bg-red-500', 'hover:bg-red-600');
                    addToCartBtn.textContent = 'Stok Habis';
                }
                
                // Show modal
                const modal = document.getElementById('detailModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat detail produk');
            });
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function selectDetailSize(size) {
        document.querySelectorAll('.detail-size-btn').forEach(btn => {
            btn.classList.remove('border-red-500', 'bg-red-500/20');
            btn.classList.add('border-gray-700');
        });
        
        const selectedBtn = document.querySelector(`[data-detail-size="${size}"]`);
        selectedBtn.classList.remove('border-gray-700');
        selectedBtn.classList.add('border-red-500', 'bg-red-500/20');
    }

    function increaseDetailQty() {
        const qtyInput = document.getElementById('detailQuantity');
        let currentQty = parseInt(qtyInput.value);
        if (currentQty < currentDetailProduct.stok) {
            qtyInput.value = currentQty + 1;
        }
    }

    function decreaseDetailQty() {
        const qtyInput = document.getElementById('detailQuantity');
        let currentQty = parseInt(qtyInput.value);
        if (currentQty > 1) {
            qtyInput.value = currentQty - 1;
        }
    }

function addToCartFromDetail() {
    console.log('=== Add to Cart from Detail ===');
    
    const selectedSize = document.querySelector('.detail-size-btn.border-red-500');
    if (!selectedSize) {
        alert('Silakan pilih ukuran terlebih dahulu!');
        return;
    }
    
    const size = selectedSize.dataset.detailSize;
    const quantity = document.getElementById('detailQuantity').value;
    
    console.log('Size:', size);
    console.log('Quantity:', quantity);
    console.log('Product ID:', currentDetailProduct.id);
    
    // Validasi quantity
    if (quantity < 1) {
        alert('Jumlah minimal adalah 1');
        return;
    }
    
    if (quantity > currentDetailProduct.stok) {
        alert('Jumlah melebihi stok yang tersedia');
        return;
    }
    
    // Ambil CSRF token dari meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    if (!csrfToken) {
        console.error('CSRF token tidak ditemukan!');
        alert('Error: CSRF token tidak ditemukan. Silakan refresh halaman.');
        return;
    }
    
    console.log('CSRF Token found:', csrfToken.substring(0, 10) + '...');
    
    // Create form and submit
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/user/cart/add/${currentDetailProduct.id}`;
    
    form.innerHTML = `
        <input type="hidden" name="_token" value="${csrfToken}">
        <input type="hidden" name="size" value="${size}">
        <input type="hidden" name="quantity" value="${quantity}">
    `;
    
    console.log('Form Action:', form.action);
    console.log('Form Data:', {
        _token: csrfToken.substring(0, 10) + '...',
        size: size,
        quantity: quantity
    });
    
    document.body.appendChild(form);
    console.log('Submitting form...');
    form.submit();
}

    // ============================================
    // SIZE MODAL FUNCTIONS (Quick Add to Cart)
    // ============================================

    function openSizeModal(productId, productName, stock) {
        currentProductId = productId;
        maxStock = stock;
        
        document.getElementById('modalProductName').textContent = productName;
        document.getElementById('maxStock').textContent = stock;
        document.getElementById('quantity').value = 1;
        document.getElementById('quantity').max = stock;
        document.getElementById('selectedSize').value = '';
        
        // Reset size buttons
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.classList.remove('border-red-500', 'bg-red-500/20');
            btn.classList.add('border-gray-700');
        });
        
        // Set form action
        document.getElementById('addToCartForm').action = '/user/cart/add/' + productId;
        
        // Show modal
        const modal = document.getElementById('sizeModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeSizeModal() {
        const modal = document.getElementById('sizeModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function selectSize(size) {
        document.getElementById('selectedSize').value = size;
        
        // Update button styles
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.classList.remove('border-red-500', 'bg-red-500/20');
            btn.classList.add('border-gray-700');
        });
        
        const selectedBtn = document.querySelector(`[data-size="${size}"]`);
        selectedBtn.classList.remove('border-gray-700');
        selectedBtn.classList.add('border-red-500', 'bg-red-500/20');
    }

    function increaseQty() {
        const qtyInput = document.getElementById('quantity');
        let currentQty = parseInt(qtyInput.value);
        if (currentQty < maxStock) {
            qtyInput.value = currentQty + 1;
        }
    }

    function decreaseQty() {
        const qtyInput = document.getElementById('quantity');
        let currentQty = parseInt(qtyInput.value);
        if (currentQty > 1) {
            qtyInput.value = currentQty - 1;
        }
    }

    // ============================================
    // UTILITY FUNCTIONS
    // ============================================

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // ============================================
    // EVENT LISTENERS
    // ============================================

    // Close detail modal when clicking outside
    document.getElementById('detailModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetailModal();
        }
    });

    // Close size modal when clicking outside
    document.getElementById('sizeModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeSizeModal();
        }
    });

    // Form validation for size modal
    document.getElementById('addToCartForm')?.addEventListener('submit', function(e) {
        const size = document.getElementById('selectedSize').value;
        if (!size) {
            e.preventDefault();
            alert('Silakan pilih ukuran terlebih dahulu!');
        }
    });
</script>

@endsection