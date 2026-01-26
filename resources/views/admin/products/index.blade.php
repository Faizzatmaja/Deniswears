@extends('layouts.admin')

@section('title', 'Daftar Produk')
@section('page-title', 'Daftar Produk')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black text-white impact-font tracking-tight mb-2">PRODUK</h1>
            <p class="text-sm text-gray-500 uppercase tracking-wide">Kelola koleksi produk premium</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
           class="inline-flex items-center gap-2 bg-white hover:bg-gray-200 text-black font-black px-6 py-3 rounded-full transition uppercase tracking-wide text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Produk
        </a>
    </div>

    {{-- Search Bar --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari produk berdasarkan nama atau kategori..."
                       class="w-full bg-black border-2 border-gray-800 rounded-xl pl-12 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-white transition duration-300 font-semibold">
            </div>
            <button type="submit" 
                    class="inline-flex items-center gap-2 bg-white hover:bg-gray-200 text-black font-black px-6 py-3 rounded-xl transition uppercase tracking-wide text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.products.index') }}" 
                   class="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white font-black px-6 py-3 rounded-xl transition uppercase tracking-wide text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <p class="text-gray-500 text-xs uppercase tracking-wider font-bold mb-3">Total Produk</p>
            <p class="text-4xl font-black text-white">{{ $products->count() }}</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <p class="text-gray-500 text-xs uppercase tracking-wider font-bold mb-3">Stok Tersedia</p>
            <p class="text-4xl font-black text-white">{{ $products->where('stok', '>', 0)->count() }}</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <p class="text-gray-500 text-xs uppercase tracking-wider font-bold mb-3">Stok Habis</p>
            <p class="text-4xl font-black text-white">{{ $products->where('stok', 0)->count() }}</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <p class="text-gray-500 text-xs uppercase tracking-wider font-bold mb-3">Kategori</p>
            <p class="text-4xl font-black text-white">{{ $products->pluck('kategori_id')->unique()->count() }}</p>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
        
        {{-- Table Header --}}
        <div class="px-6 py-4 border-b border-gray-800">
            <h2 class="text-xl font-black text-white uppercase tracking-wide">Semua Produk</h2>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-black/40">
                    <tr>
                        <th class="py-4 px-6 text-left text-xs font-black text-gray-500 uppercase tracking-wider">#</th>
                        <th class="py-4 px-6 text-left text-xs font-black text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th class="py-4 px-6 text-left text-xs font-black text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="py-4 px-6 text-left text-xs font-black text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="py-4 px-6 text-center text-xs font-black text-gray-500 uppercase tracking-wider">Size</th>
                        <th class="py-4 px-6 text-left text-xs font-black text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="py-4 px-6 text-center text-xs font-black text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="py-4 px-6 text-center text-xs font-black text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-800/50 transition">

                            {{-- No --}}
                            <td class="py-4 px-6 text-gray-500 font-bold">
                                {{ $loop->iteration }}
                            </td>

                            {{-- Gambar --}}
                            <td class="py-4 px-6">
                                @if ($product->gambar)
                                    <img src="{{ asset('storage/' . $product->gambar) }}"
                                         class="w-16 h-16 object-cover rounded-xl border-2 border-gray-800">
                                @else
                                    <div class="w-16 h-16 bg-gray-800 rounded-xl flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            {{-- Nama Produk --}}
                            <td class="py-4 px-6">
                                <p class="font-black text-white text-base">{{ $product->nama_produk }}</p>
                            </td>

                            {{-- Kategori --}}
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-black bg-gray-800 text-gray-400 border border-gray-700">
                                    {{ $product->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                </span>
                            </td>

                            {{-- Size --}}
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-black bg-gray-800 text-white border border-gray-700">
                                    {{ $product->size }}
                                </span>
                            </td>

                            {{-- Harga --}}
                            <td class="py-4 px-6">
                                <p class="text-white font-black text-base">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            </td>

                            {{-- Stok --}}
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-black border
                                    {{ $product->stok > 0 ? 'bg-gray-800 text-white border-gray-700' : 'bg-red-500/20 text-red-500 border-red-500' }}">
                                    {{ $product->stok }} pcs
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="py-4 px-6">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-200 text-black text-xs font-black rounded-lg transition uppercase tracking-wide">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-black rounded-lg transition uppercase tracking-wide">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600 font-bold">Belum ada produk</p>
                                    <a href="{{ route('admin.products.create') }}" 
                                       class="inline-flex items-center gap-2 bg-white hover:bg-gray-200 text-black font-black px-4 py-2 rounded-full transition text-xs uppercase tracking-wide">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Produk Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-400 font-semibold">
                    Menampilkan <span class="text-white font-black">{{ $products->firstItem() }}</span> 
                    sampai <span class="text-white font-black">{{ $products->lastItem() }}</span> 
                    dari <span class="text-white font-black">{{ $products->total() }}</span> produk
                </div>
                
                <div class="flex items-center gap-2">
                    {{-- Previous Button --}}
                    @if ($products->onFirstPage())
                        <span class="px-4 py-2 bg-gray-800 text-gray-600 rounded-lg font-bold uppercase tracking-wide text-xs cursor-not-allowed">
                            Prev
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" 
                           class="px-4 py-2 bg-white hover:bg-gray-200 text-black rounded-lg font-black uppercase tracking-wide text-xs transition">
                            Prev
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    <div class="flex items-center gap-1">
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if ($page == $products->currentPage())
                                <span class="px-4 py-2 bg-white text-black rounded-lg font-black text-xs">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" 
                                   class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg font-bold text-xs transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    </div>

                    {{-- Next Button --}}
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" 
                           class="px-4 py-2 bg-white hover:bg-gray-200 text-black rounded-lg font-black uppercase tracking-wide text-xs transition">
                            Next
                        </a>
                    @else
                        <span class="px-4 py-2 bg-gray-800 text-gray-600 rounded-lg font-bold uppercase tracking-wide text-xs cursor-not-allowed">
                            Next
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @endif

</div>

<style>
    .impact-font {
        font-family: Impact, 'Arial Black', sans-serif;
        letter-spacing: -0.02em;
    }
</style>
@endsection