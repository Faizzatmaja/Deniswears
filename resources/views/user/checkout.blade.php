@extends('layouts.user')

@section('title', 'Checkout - Deniswears')

@section('content')
{{-- Hero Header --}}
<div class="relative overflow-hidden py-16" style="min-height: 250px;">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6">
        <div class="flex items-center gap-4 mb-4">
            <svg class="w-12 h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
            <h1 class="text-6xl font-black text-white leading-none drop-shadow-lg" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
                PEMBAYARAN
            </h1>
        </div>
        <p class="text-gray-100 text-lg drop-shadow-md">Lengkapi data untuk menyelesaikan pesanan</p>
    </div>
</div>

{{-- Checkout Content --}}
<div class="bg-black min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-6">
        <form action="{{ route('user.checkout.process') }}" method="POST">
            @csrf
            
            <div class="grid gap-8">
                {{-- Data Pembeli --}}
                <div class="bg-gray-900 rounded-2xl p-8 shadow-lg border border-gray-800">
                    <h2 class="text-2xl font-black mb-6 uppercase text-white flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Data Penerima
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', Auth::user()->name) }}" required
                                   class="w-full bg-gray-800 border-2 border-gray-700 rounded-xl p-3 text-white focus:border-red-500 focus:outline-none">
                            @error('nama_lengkap')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">No. Telepon / WhatsApp *</label>
                            <input type="tel" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="08xxxxxxxxxx" required
                                   class="w-full bg-gray-800 border-2 border-gray-700 rounded-xl p-3 text-white focus:border-red-500 focus:outline-none">
                            @error('no_telepon')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Alamat Lengkap *</label>
                            <textarea name="alamat_lengkap" rows="4" required placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan, Kota, Provinsi, Kode Pos"
                                      class="w-full bg-gray-800 border-2 border-gray-700 rounded-xl p-3 text-white focus:border-red-500 focus:outline-none resize-none">{{ old('alamat_lengkap') }}</textarea>
                            @error('alamat_lengkap')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div class="bg-gray-900 rounded-2xl p-8 shadow-lg border border-gray-800">
                    <h2 class="text-2xl font-black mb-6 uppercase text-white flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        Metode Pembayaran
                    </h2>
                    
                    <div class="space-y-3">
                        {{-- Transfer Bank --}}
                        <label class="block cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="transfer_bank" class="peer hidden" required>
                            <div class="border-2 border-gray-700 rounded-xl p-4 peer-checked:border-red-500 peer-checked:bg-red-500/10 hover:border-gray-600 transition">
                                <div class="flex items-center gap-3">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                    <span class="font-bold text-white">Transfer Bank</span>
                                </div>
                            </div>
                        </label>

                        {{-- E-Wallet --}}
                        <label class="block cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="ewallet" class="peer hidden">
                            <div class="border-2 border-gray-700 rounded-xl p-4 peer-checked:border-red-500 peer-checked:bg-red-500/10 hover:border-gray-600 transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="font-bold text-white">E-Wallet (OVO, DANA, GoPay)</span>
                                    </div>
                                </div>
                            </div>
                        </label>

                        {{-- COD --}}
                        <label class="block cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="cod" class="peer hidden">
                            <div class="border-2 border-gray-700 rounded-xl p-4 peer-checked:border-red-500 peer-checked:bg-red-500/10 hover:border-gray-600 transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <span class="font-bold text-white">COD (Bayar di Tempat)</span>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Ringkasan Pesanan --}}
                <div class="bg-gray-900 rounded-2xl p-8 shadow-lg border border-gray-800">
                    <h2 class="text-2xl font-black mb-6 uppercase text-white">Ringkasan Pesanan</h2>
                    
                    {{-- Cart Items Preview --}}
                    <div class="space-y-3 mb-6 pb-6 border-b-2 border-gray-800 max-h-64 overflow-y-auto">
                        @foreach($cartItems as $item)
                        <div class="flex gap-3">
                            <img src="{{ $item->product->gambar ? asset('storage/' . $item->product->gambar) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=100' }}" 
                                 alt="{{ $item->product->nama_produk }}"
                                 class="w-16 h-16 object-cover rounded-lg">
                            <div class="flex-1">
                                <p class="text-white font-bold text-sm">{{ $item->product->nama_produk }}</p>
                                <p class="text-gray-400 text-xs">{{ $item->size }} × {{ $item->quantity }}</p>
                                @php
                                    $price = $item->product->harga_diskon ?? $item->product->harga;
                                @endphp
                                <p class="text-red-500 font-bold text-sm">Rp {{ number_format($price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 mb-6 pb-6 border-b-2 border-gray-800">
                        <div class="flex justify-between text-gray-400">
                            <span>Total Item</span>
                            <span class="text-white font-bold">{{ $cartItems->sum('quantity') }} pcs</span>
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
                            <span class="text-3xl font-black text-red-500">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-black py-4 rounded-xl transition uppercase tracking-wide shadow-lg hover:shadow-xl mb-3">
                        Konfirmasi Pesanan
                    </button>
                    
                    <a href="{{ route('user.cart') }}" class="block w-full bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 rounded-xl transition text-center border border-gray-700">
                        Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection