@extends('layouts.user')

@section('title', 'Pesanan Saya - Deniswears')

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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h1 class="text-6xl font-black text-white leading-none drop-shadow-lg" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
                PESANAN ANDA
            </h1>
        </div>
        <p class="text-gray-100 text-lg drop-shadow-md">Lacak status pesanan Anda</p>
    </div>
</div>

<div class="bg-black min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-6">
        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-lg border border-gray-800 hover:border-red-500/50 transition">
                    {{-- Order Header --}}
                    <div class="bg-gray-800/50 p-6 border-b border-gray-700">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Nomor Pesanan</p>
                                <p class="text-white font-black text-xl">{{ $order->order_number }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Tanggal Pesanan</p>
                                <p class="text-white font-bold">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            
                            <div>
                                <span class="{{ $order->getStatusBadgeColor() }} text-white px-6 py-2 rounded-full text-sm font-black uppercase">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Order Content --}}
                    <div class="p-6">
                        {{-- Penerima --}}
                        <div class="bg-gray-800/50 rounded-xl p-4 mb-6">
                            <div class="flex items-start gap-3 mb-3">
                                <svg class="w-5 h-5 text-red-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <div>
                                    <p class="text-white font-bold">{{ $order->nama_lengkap }}</p>
                                    <p class="text-gray-400 text-sm">{{ $order->no_telepon }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <p class="text-gray-300 text-sm">{{ $order->alamat_lengkap }}</p>
                            </div>
                        </div>

                        {{-- Products --}}
                        <div class="space-y-4 mb-6">
                            @foreach($order->items as $item)
                            <div class="flex gap-4">
                                <img src="{{ $item->product->gambar ? asset('storage/' . $item->product->gambar) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=100' }}" 
                                     alt="{{ $item->nama_produk }}"
                                     class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <p class="text-white font-bold">{{ $item->nama_produk }}</p>
                                    <p class="text-gray-400 text-sm">{{ $item->size }} × {{ $item->quantity }}</p>
                                    <p class="text-red-500 font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Total & Payment Method --}}
                        <div class="flex items-center justify-between pt-4 border-t border-gray-700">
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Metode Pembayaran</p>
                                <p class="text-white font-bold">
                                    @if($order->metode_pembayaran === 'transfer_bank')
                                        Transfer Bank
                                    @elseif($order->metode_pembayaran === 'ewallet')
                                        E-Wallet
                                    @else
                                        COD (Bayar di Tempat)
                                    @endif
                                </p>
                            </div>
                            
                            <div class="text-right">
                                <p class="text-gray-400 text-sm">Total Pembayaran</p>
                                <p class="text-3xl font-black text-red-500">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-gray-900 rounded-3xl shadow-lg border border-gray-800">
                <div class="w-32 h-32 mx-auto mb-6 bg-gray-800 rounded-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-white mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-400 mb-8">Anda belum pernah melakukan pemesanan</p>
                <a href="{{ route('user.home') }}" class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold px-8 py-4 rounded-full transition shadow-lg hover:shadow-xl">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</div>

@endsection