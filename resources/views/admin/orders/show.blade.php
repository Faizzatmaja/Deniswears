@extends('layouts.admin')

@section('title', 'Detail Pesanan - Deniswears Admin')
@section('page-title', 'Detail Pesanan')
@section('page-description', 'Order details and management')

@section('content')
<div class="space-y-6">
    {{-- Back Button --}}
    <div>
        <a href="{{ route('admin.dashboard') }}" 
           class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Order Details --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Order Info --}}
            <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
                <div class="bg-gray-800/50 p-6 border-b border-gray-700">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <h3 class="text-2xl font-black text-white mb-1" style="font-family: 'Impact', sans-serif;">
                                {{ $order->order_number }}
                            </h3>
                            <p class="text-gray-400 text-sm">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        @if($order->status === 'selesai')
                            <span class="px-6 py-3 text-sm font-bold rounded-full bg-green-500/20 text-green-400 border border-green-500/30">
                                SELESAI
                            </span>
                        @elseif($order->status === 'diproses')
                            <span class="px-6 py-3 text-sm font-bold rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30">
                                DIPROSES
                            </span>
                        @elseif($order->status === 'dikirim')
                            <span class="px-6 py-3 text-sm font-bold rounded-full bg-purple-500/20 text-purple-400 border border-purple-500/30">
                                DIKIRIM
                            </span>
                        @elseif($order->status === 'dibatalkan')
                            <span class="px-6 py-3 text-sm font-bold rounded-full bg-red-500/20 text-red-400 border border-red-500/30">
                                DIBATALKAN
                            </span>
                        @else
                            <span class="px-6 py-3 text-sm font-bold rounded-full bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                                PENDING
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Customer Info --}}
                <div class="p-6 border-b border-gray-700">
                    <h4 class="text-white font-bold mb-4 uppercase tracking-wide text-sm">Informasi Pelanggan</h4>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <div>
                                <p class="text-gray-400 text-xs">Nama Lengkap</p>
                                <p class="text-white font-semibold">{{ $order->nama_lengkap }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <p class="text-gray-400 text-xs">No. Telepon</p>
                                <p class="text-white font-semibold">{{ $order->no_telepon }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <div>
                                <p class="text-gray-400 text-xs">Alamat Pengiriman</p>
                                <p class="text-white">{{ $order->alamat_lengkap }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            <div>
                                <p class="text-gray-400 text-xs">Metode Pembayaran</p>
                                <p class="text-white font-semibold">
                                    @if($order->metode_pembayaran === 'transfer_bank')
                                        Transfer Bank
                                    @elseif($order->metode_pembayaran === 'ewallet')
                                        E-Wallet
                                    @else
                                        COD (Cash on Delivery)
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Products --}}
                <div class="p-6">
                    <h4 class="text-white font-bold mb-4 uppercase tracking-wide text-sm">Produk yang Dipesan</h4>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex gap-4 bg-gray-800/50 rounded-lg p-4">
                            <img src="{{ $item->product->gambar ? asset('storage/' . $item->product->gambar) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=100' }}" 
                                 alt="{{ $item->nama_produk }}"
                                 class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                            <div class="flex-1">
                                <p class="text-white font-bold mb-1">{{ $item->nama_produk }}</p>
                                <p class="text-gray-400 text-sm mb-2">Size: {{ $item->size }} • Qty: {{ $item->quantity }}</p>
                                <p class="text-red-500 font-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-xs">Subtotal</p>
                                <p class="text-white font-bold text-lg">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Total --}}
                    <div class="mt-6 pt-6 border-t border-gray-700">
                        <div class="flex justify-between items-center">
                            <p class="text-gray-400 text-lg">Total Pembayaran</p>
                            <p class="text-3xl font-black text-red-500">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Update Status --}}
            <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
                <div class="bg-gray-800/50 p-4 border-b border-gray-700">
                    <h4 class="text-white font-bold uppercase tracking-wide text-sm">Update Status Pesanan</h4>
                </div>
                <div class="p-4">
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Status Pesanan</label>
                                <select name="status" class="w-full bg-gray-800 border-2 border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-red-500 transition">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diproses" {{ $order->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="dikirim" {{ $order->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-lg transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Delete Order --}}
            <div class="bg-gray-900 rounded-xl border border-red-500/30 overflow-hidden">
                <div class="bg-red-500/10 p-4 border-b border-red-500/30">
                    <h4 class="text-red-400 font-bold uppercase tracking-wide text-sm">Danger Zone</h4>
                </div>
                <div class="p-4">
                    <p class="text-gray-400 text-sm mb-4">Menghapus pesanan akan menghapus semua data terkait dan tidak dapat dikembalikan.</p>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-500/20 hover:bg-red-500 text-red-400 hover:text-white border border-red-500/30 font-bold py-3 rounded-lg transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus Pesanan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection