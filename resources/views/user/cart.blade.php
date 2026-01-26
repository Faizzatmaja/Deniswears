@extends('layouts.user')

@section('title', 'Keranjang Belanja - Deniswears')

@section('content')
{{-- Hero Header - Dark Theme --}}
<div class="relative overflow-hidden py-16" style="min-height: 250px;">
     
    {{-- Subtle Background Elements --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6">
        <div class="flex items-center gap-4 mb-4">
            <svg class="w-12 h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <h1 class="text-6xl font-black text-white leading-none drop-shadow-lg" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
                KERANJANG
            </h1>
        </div>
        <p class="text-gray-100 text-lg drop-shadow-md">Kelola produk yang akan Anda beli</p>
    </div>
</div>

{{-- Cart Content --}}
<div class="bg-black min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-6">
        @if($cartItems->count() > 0)
        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Cart Items --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                <div class="group bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:shadow-red-500/20 transition-all duration-300 border border-gray-800 hover:border-red-500">
                    <div class="p-6 flex gap-6">
                        {{-- Product Image --}}
                        <div class="w-32 h-32 flex-shrink-0 rounded-xl overflow-hidden bg-gray-800">
                            <img src="{{ $item->product->gambar ? asset('storage/' . $item->product->gambar) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=400' }}" 
                                 alt="{{ $item->product->nama_produk }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>

                        {{-- Product Info --}}
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="text-xl font-bold mb-1 text-white">{{ $item->product->nama_produk }}</h3>
                                    <p class="text-gray-400 text-sm">{{ $item->product->kategori->nama_kategori ?? 'Uncategorized' }}</p>
                                </div>
                                
                                {{-- Action Buttons --}}
                                <div class="flex items-center gap-2">
                                    {{-- Edit Button --}}
                                    <button onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->product->nama_produk) }}', '{{ $item->size }}', {{ $item->quantity }}, '{{ addslashes($item->notes) }}', {{ $item->product->stok }})" 
                                            class="text-gray-400 hover:text-red-500 transition p-2 rounded-lg hover:bg-red-500/10">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    
                                    {{-- Remove Button --}}
                                    <form action="{{ route('user.cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition p-2 rounded-lg hover:bg-red-500/10">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- Size & Notes --}}
                            <div class="mb-4 space-y-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-400 text-sm">Ukuran:</span>
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $item->size }}
                                    </span>
                                </div>
                                
                                @if($item->notes)
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-400 text-sm">Catatan:</span>
                                    <span class="text-gray-300 text-sm">{{ $item->notes }}</span>
                                </div>
                                @endif
                            </div>

                            {{-- Quantity & Price --}}
                            <div class="flex items-center justify-between">
                                {{-- Quantity Control --}}
                                <form action="{{ route('user.cart.update', $item->id) }}" method="POST" class="flex items-center gap-3">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="size" value="{{ $item->size }}">
                                    <input type="hidden" name="notes" value="{{ $item->notes }}">
                                    
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="updateQuantity(this, -1, {{ $item->product->stok }})" 
                                                class="w-9 h-9 bg-gray-800 hover:bg-gray-700 text-white font-black rounded-lg transition border border-gray-700">
                                            -
                                        </button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stok }}" 
                                               class="w-16 text-center bg-gray-800 border-2 border-gray-700 rounded-lg py-2 text-white font-bold"
                                               onchange="this.form.submit()">
                                        <button type="button" onclick="updateQuantity(this, 1, {{ $item->product->stok }})" 
                                                class="w-9 h-9 bg-gray-800 hover:bg-gray-700 text-white font-black rounded-lg transition border border-gray-700">
                                            +
                                        </button>
                                    </div>
                                    
                                    <span class="text-xs text-gray-400">Stok: <span class="text-white font-bold">{{ $item->product->stok }}</span></span>
                                </form>

                                {{-- Price --}}
                                <div class="text-right">
                                    @php
                                        $price = $item->product->harga_diskon ?? $item->product->harga;
                                        $subtotal = $price * $item->quantity;
                                    @endphp
                                    
                                    <p class="text-sm text-gray-400">
                                        Rp {{ number_format($price, 0, ',', '.') }} x {{ $item->quantity }}
                                    </p>
                                    <p class="text-xl font-bold text-red-500">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- Clear Cart Button --}}
                <form action="{{ route('user.cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan seluruh keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-gray-900 border-2 border-red-500/30 hover:border-red-500 hover:bg-red-500/10 text-red-500 font-bold py-3 rounded-xl transition">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Kosongkan Keranjang
                        </span>
                    </button>
                </form>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-gray-900 rounded-2xl p-6 sticky top-24 shadow-lg border border-gray-800">
                    <h2 class="text-2xl font-black mb-6 uppercase text-white">Ringkasan Pesanan</h2>
                    
                    @php
                        $total = 0;
                        foreach($cartItems as $item) {
                            $price = $item->product->harga_diskon ?? $item->product->harga;
                            $total += $price * $item->quantity;
                        }
                    @endphp

                    <div class="space-y-3 mb-6 pb-6 border-b-2 border-gray-800">
                        <div class="flex justify-between text-gray-400">
                            <span>Total Item</span>
                            <span class="text-white font-bold">{{ $cartItems->count() }} produk</span>
                        </div>
                        
                        <div class="flex justify-between text-gray-400">
                            <span>Subtotal</span>
                            <span class="text-white font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="flex justify-between text-gray-400">
                            <span>Ongkir</span>
                            <span class="text-green-500 font-bold">Gratis</span>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-white">Total Pembayaran</span>
                            <span class="text-2xl font-black text-red-500">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <a 
                    href="{{ route('user.checkout') }}" 
                    class="block w-full bg-red-500 hover:bg-red-600 text-white font-black 
                        py-4 rounded-xl transition uppercase tracking-wide text-sm 
                        shadow-lg hover:shadow-xl mb-3 text-center">
                    Lanjut ke Pembayaran
                    </a>


                    
                    <a href="{{ route('user.home') }}" class="block w-full bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 rounded-xl transition text-center border border-gray-700">
                        Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>

        @else
        {{-- Empty Cart - Dark Theme --}}
        <div class="text-center py-20 bg-gray-900 rounded-3xl shadow-lg border border-gray-800">
            <div class="w-32 h-32 mx-auto mb-6 bg-gray-800 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h3 class="text-3xl font-bold text-white mb-2">Keranjang Belanja Kosong</h3>
            <p class="text-gray-400 mb-8">Belum ada produk yang ditambahkan ke keranjang</p>
            <a href="{{ route('user.home') }}" class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold px-8 py-4 rounded-full transition shadow-lg hover:shadow-xl">
                Mulai Belanja
            </a>
        </div>
        @endif
    </div>
</div>

{{-- Edit Cart Item Modal - Dark Theme --}}
<div id="editModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-gray-900 rounded-2xl max-w-md w-full p-8 relative shadow-2xl border border-gray-800">
        {{-- Close Button --}}
        <button onclick="closeEditModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <h2 class="text-2xl font-black text-white mb-2 uppercase tracking-tight" id="editModalProductName">Edit Produk</h2>
        <p class="text-gray-400 text-sm mb-6">Ubah ukuran, jumlah, atau catatan</p>

        <form id="editCartForm" method="POST" action="">
            @csrf
            @method('PATCH')
            
            {{-- Size Selection --}}
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-300 mb-3 uppercase tracking-wide">Ukuran</label>
                <div class="grid grid-cols-4 gap-3">
                    <button type="button" onclick="selectEditSize('S')" data-edit-size="S" class="edit-size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                        S
                    </button>
                    <button type="button" onclick="selectEditSize('M')" data-edit-size="M" class="edit-size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                        M
                    </button>
                    <button type="button" onclick="selectEditSize('L')" data-edit-size="L" class="edit-size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                        L
                    </button>
                    <button type="button" onclick="selectEditSize('XL')" data-edit-size="XL" class="edit-size-btn py-3 border-2 border-gray-700 bg-gray-800 rounded-xl font-black text-white hover:border-red-500 hover:bg-red-500/20 transition">
                        XL
                    </button>
                </div>
                <input type="hidden" name="size" id="editSelectedSize" required>
            </div>

            {{-- Quantity Selection --}}
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-300 mb-3 uppercase tracking-wide">Jumlah</label>
                <div class="flex items-center gap-4">
                    <button type="button" onclick="decreaseEditQty()" class="w-12 h-12 bg-gray-800 hover:bg-gray-700 text-white font-black rounded-xl transition border border-gray-700">
                        -
                    </button>
                    <input type="number" name="quantity" id="editQuantity" value="1" min="1" readonly
                           class="w-20 text-center bg-gray-800 border-2 border-gray-700 rounded-xl py-3 text-white font-black text-lg">
                    <button type="button" onclick="increaseEditQty()" class="w-12 h-12 bg-gray-800 hover:bg-gray-700 text-white font-black rounded-xl transition border border-gray-700">
                        +
                    </button>
                    <span class="text-gray-400 text-sm">
                        Stok: <span id="editMaxStock" class="text-white font-bold">0</span>
                    </span>
                </div>
            </div>

            {{-- Notes --}}
            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-300 mb-3 uppercase tracking-wide">Catatan (Opsional)</label>
                <textarea name="notes" id="editNotes" rows="3" 
                          placeholder="Contoh: Warna hitam, ukuran longgar, dll..."
                          class="w-full bg-gray-800 border-2 border-gray-700 rounded-xl p-3 text-white placeholder-gray-500 focus:border-red-500 focus:outline-none resize-none"></textarea>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-black py-4 rounded-xl transition uppercase tracking-wide text-sm shadow-lg hover:shadow-xl">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Produk
                </span>
            </button>
        </form>
    </div>
</div>

<script>
function updateQuantity(button, change, maxStock) {
    const form = button.closest('form');
    const input = form.querySelector('input[name="quantity"]');
    let currentValue = parseInt(input.value);
    let newValue = currentValue + change;
    
    if (newValue >= 1 && newValue <= maxStock) {
        input.value = newValue;
        form.submit();
    }
}

// Edit Modal Functions
let editMaxStock = 0;

function openEditModal(cartId, productName, currentSize, currentQty, currentNotes, maxStock) {
    editMaxStock = maxStock;
    
    document.getElementById('editModalProductName').textContent = productName;
    document.getElementById('editMaxStock').textContent = maxStock;
    document.getElementById('editQuantity').value = currentQty;
    document.getElementById('editQuantity').max = maxStock;
    document.getElementById('editSelectedSize').value = currentSize;
    document.getElementById('editNotes').value = currentNotes || '';
    
    // Reset and set size buttons
    document.querySelectorAll('.edit-size-btn').forEach(btn => {
        btn.classList.remove('border-red-500', 'bg-red-500/20');
        btn.classList.add('border-gray-700');
    });
    
    const selectedBtn = document.querySelector(`[data-edit-size="${currentSize}"]`);
    if (selectedBtn) {
        selectedBtn.classList.remove('border-gray-700');
        selectedBtn.classList.add('border-red-500', 'bg-red-500/20');
    }
    
    // Set form action
    const baseUrl = "{{ route('user.cart.update', ':id') }}";
    document.getElementById('editCartForm').action = baseUrl.replace(':id', cartId);
    
    // Show modal
    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function selectEditSize(size) {
    document.getElementById('editSelectedSize').value = size;
    
    document.querySelectorAll('.edit-size-btn').forEach(btn => {
        btn.classList.remove('border-red-500', 'bg-red-500/20');
        btn.classList.add('border-gray-700');
    });
    
    const selectedBtn = document.querySelector(`[data-edit-size="${size}"]`);
    selectedBtn.classList.remove('border-gray-700');
    selectedBtn.classList.add('border-red-500', 'bg-red-500/20');
}

function increaseEditQty() {
    const qtyInput = document.getElementById('editQuantity');
    let currentQty = parseInt(qtyInput.value);
    if (currentQty < editMaxStock) {
        qtyInput.value = currentQty + 1;
    }
}

function decreaseEditQty() {
    const qtyInput = document.getElementById('editQuantity');
    let currentQty = parseInt(qtyInput.value);
    if (currentQty > 1) {
        qtyInput.value = currentQty - 1;
    }
}

// Close modal when clicking outside
document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
</script>

@endsection