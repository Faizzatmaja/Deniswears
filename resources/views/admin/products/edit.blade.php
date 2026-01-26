@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.products.index') }}" 
           class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition text-sm font-semibold uppercase tracking-wide mb-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-4xl font-black text-white impact-font tracking-tight mb-2">EDIT PRODUK</h1>
        <p class="text-sm text-gray-400 uppercase tracking-wide font-semibold">Perbarui data produk dengan benar</p>
    </div>

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="bg-red-500/10 border-2 border-red-500 rounded-2xl p-4 mb-6">
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-red-500 font-bold text-sm uppercase tracking-wide mb-2">Terdapat Kesalahan</h3>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-400 text-sm font-semibold">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8">
        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nama Produk --}}
            <div>
                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">Nama Produk</label>
                <input type="text"
                       name="nama_produk"
                       value="{{ old('nama_produk', $product->nama_produk) }}"
                       placeholder="Contoh: Classic Baseball Cap"
                       class="w-full bg-black border-2 border-gray-800 rounded-xl px-4 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-red-500 transition duration-300 font-semibold"
                       required>
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">Kategori</label>
                <select name="kategori_id" 
                        class="w-full bg-black border-2 border-gray-800 rounded-xl px-4 py-4 text-white focus:outline-none focus:border-red-500 transition duration-300 font-semibold"
                        required>
                    <option value="" class="bg-gray-900">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}"
                                class="bg-gray-900"
                                {{ old('kategori_id', $product->kategori_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Size --}}
            <div>
                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">Size</label>
                <select name="size" 
                        class="w-full bg-black border-2 border-gray-800 rounded-xl px-4 py-4 text-white focus:outline-none focus:border-red-500 transition duration-300 font-semibold"
                        required>
                    <option value="" class="bg-gray-900">-- Pilih Size --</option>
                    @foreach (['S','M','L','XL'] as $size)
                        <option value="{{ $size }}"
                                class="bg-gray-900"
                                {{ old('size', $product->size) == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Harga & Stok --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">Harga (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">Rp</span>
                        <input type="number"
                               name="harga"
                               min="0"
                               value="{{ old('harga', $product->harga) }}"
                               placeholder="150000"
                               class="w-full bg-black border-2 border-gray-800 rounded-xl pl-12 pr-4 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-red-500 transition duration-300 font-bold"
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">Stok</label>
                    <input type="number"
                           name="stok"
                           min="0"
                           value="{{ old('stok', $product->stok) }}"
                           placeholder="100"
                           class="w-full bg-black border-2 border-gray-800 rounded-xl px-4 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-red-500 transition duration-300 font-bold"
                           required>
                </div>
            </div>

            {{-- Gambar Produk --}}
            <div>
                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">Gambar Produk</label>
                
                {{-- Preview Gambar Saat Ini --}}
                @if ($product->gambar)
                    <div class="mb-4 p-4 bg-black border-2 border-gray-800 rounded-xl">
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-3">Gambar Saat Ini:</p>
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/' . $product->gambar) }}"
                                 alt="{{ $product->nama_produk }}"
                                 class="w-40 h-40 object-cover rounded-xl border-2 border-gray-700">
                            <div class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded-lg text-xs font-bold uppercase">
                                Current
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Upload Gambar Baru --}}
                <div class="relative">
                    <input type="file"
                           name="gambar"
                           accept="image/*"
                           class="w-full bg-black border-2 border-gray-800 rounded-xl px-4 py-4 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-red-500 file:text-white file:font-bold file:uppercase file:tracking-wide file:text-xs hover:file:bg-red-600 file:cursor-pointer focus:outline-none focus:border-red-500 transition duration-300">
                </div>
                <p class="text-xs text-gray-500 mt-2 font-semibold">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Kosongkan jika tidak ingin mengubah gambar. Format JPG/PNG, maksimal 2MB
                </p>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">Deskripsi</label>
                <textarea name="deskripsi"
                          rows="5"
                          placeholder="Deskripsi singkat tentang produk ini..."
                          class="w-full bg-black border-2 border-gray-800 rounded-xl px-4 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-red-500 transition duration-300 font-semibold resize-none"
                          required>{{ old('deskripsi', $product->deskripsi) }}</textarea>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col-reverse md:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-800">
                <a href="{{ route('admin.products.index') }}"
                   class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 bg-gray-800 hover:bg-gray-700 text-white text-sm font-bold rounded-xl transition uppercase tracking-wide border-2 border-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>

                <button type="submit"
                        class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-red-500 hover:bg-red-600 text-white text-sm font-black rounded-xl transition uppercase tracking-wide shadow-lg shadow-red-500/50 hover:shadow-red-500/70 border-2 border-red-500 hover:border-red-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update Produk
                </button>
            </div>

        </form>
    </div>

    {{-- Warning Card --}}
    <div class="mt-6 bg-yellow-500/10 border-2 border-yellow-500/30 rounded-2xl p-6">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-yellow-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-yellow-400 font-bold text-sm uppercase tracking-wide mb-2">Peringatan</h3>
                <ul class="space-y-1 text-sm text-gray-400">
                    <li class="flex items-start gap-2">
                        <span class="text-yellow-400 mt-0.5">•</span>
                        <span>Perubahan data akan langsung mempengaruhi tampilan produk di website</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-yellow-400 mt-0.5">•</span>
                        <span>Pastikan gambar yang diupload berkualitas baik</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-yellow-400 mt-0.5">•</span>
                        <span>Update stok dengan hati-hati untuk menghindari overselling</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

<style>
    .impact-font {
        font-family: Impact, 'Arial Black', sans-serif;
        letter-spacing: -0.02em;
    }
</style>
@endsection