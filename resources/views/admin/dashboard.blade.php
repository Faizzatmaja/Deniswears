@extends('layouts.admin')

@section('title', 'Dashboard - Deniswears Admin')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of your store performance')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-gray-900 to-black rounded-xl p-6 shadow-lg border border-gray-800">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black text-white mb-1" style="font-family: 'Impact', sans-serif; letter-spacing: -0.02em;">
                    WELCOME BACK, {{ strtoupper(auth()->user()->name) }}
                </h1>
                <p class="text-gray-400">
                    Here is a quick overview of your store today
                </p>
            </div>
            <div class="text-sm text-gray-500 bg-gray-800 px-4 py-2 rounded-lg">
                {{ now()->format('d M Y') }}
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-gray-900 rounded-xl p-6 shadow-lg border border-gray-800 hover:border-red-500 transition group">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-400 uppercase tracking-wide">Total Products</p>
                <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-black text-white">{{ number_format($totalProducts) }}</h3>
            <p class="text-xs text-green-400 mt-1">All products</p>
        </div>

        <div class="bg-gray-900 rounded-xl p-6 shadow-lg border border-gray-800 hover:border-red-500 transition group">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-400 uppercase tracking-wide">Total Orders</p>
                <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-black text-white">{{ number_format($totalOrders) }}</h3>
            <p class="text-xs text-green-400 mt-1">+{{ $ordersToday }} today</p>
        </div>

        <div class="bg-gray-900 rounded-xl p-6 shadow-lg border border-gray-800 hover:border-red-500 transition group">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-400 uppercase tracking-wide">Customers</p>
                <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-black text-white">{{ number_format($totalCustomers) }}</h3>
            <p class="text-xs text-green-400 mt-1">Active users</p>
        </div>

        <div class="bg-gradient-to-br from-red-500 to-red-700 rounded-xl p-6 shadow-lg border border-red-600 hover:shadow-red-500/50 transition group">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-red-100 uppercase tracking-wide">Revenue</p>
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-black text-white">Rp {{ number_format($totalRevenue / 1000000, 1) }}M</h3>
            <p class="text-xs text-red-100 mt-1">Total earnings</p>
        </div>
    </div>

    {{-- All Orders Table --}}
    <div class="bg-gray-900 rounded-xl shadow-lg border border-gray-800">
        <div class="p-6 border-b border-gray-800 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-black text-white mb-1" style="font-family: 'Impact', sans-serif;">
                    ALL ORDERS
                </h3>
                <p class="text-sm text-gray-400">Manage all customer orders</p>
            </div>
        </div>

        @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-800 text-gray-400">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold uppercase tracking-wide text-xs">Order Number</th>
                        <th class="px-6 py-4 text-left font-semibold uppercase tracking-wide text-xs">Customer</th>
                        <th class="px-6 py-4 text-left font-semibold uppercase tracking-wide text-xs">Date</th>
                        <th class="px-6 py-4 text-left font-semibold uppercase tracking-wide text-xs">Amount</th>
                        <th class="px-6 py-4 text-left font-semibold uppercase tracking-wide text-xs">Status</th>
                        <th class="px-6 py-4 text-center font-semibold uppercase tracking-wide text-xs">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-800 transition">
                        <td class="px-6 py-4 font-bold text-white">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 text-gray-300">{{ $order->nama_lengkap }}</td>
                        <td class="px-6 py-4 text-gray-400">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-white font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if($order->status === 'selesai')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-500/20 text-green-400 border border-green-500/30">
                                    Selesai
                                </span>
                            @elseif($order->status === 'diproses')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30">
                                    Diproses
                                </span>
                            @elseif($order->status === 'dikirim')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-purple-500/20 text-purple-400 border border-purple-500/30">
                                    Dikirim
                                </span>
                            @elseif($order->status === 'dibatalkan')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-500/20 text-red-400 border border-red-500/30">
                                    Dibatalkan
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class="inline-block px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-lg transition">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-6 border-t border-gray-800">
            {{ $orders->links() }}
        </div>
        @else
        <div class="p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <h3 class="text-xl font-bold text-white mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-500">Pesanan akan muncul di sini setelah pelanggan melakukan pemesanan</p>
        </div>
        @endif
    </div>
</div>
@endsection