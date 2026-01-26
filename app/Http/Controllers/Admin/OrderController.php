<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Daftar semua pesanan
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    // Detail pesanan
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    // Update status pesanan
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,dikirim,selesai,dibatalkan',
        ]);

        $order = Order::findOrFail($id);
        
        // Jika dibatalkan, kembalikan stok
        if ($request->status === 'dibatalkan' && $order->status !== 'dibatalkan') {
            foreach ($order->items as $item) {
                $item->product->increment('stok', $item->quantity);
            }
        }

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // Kembalikan stok jika pesanan belum selesai
        if ($order->status !== 'selesai') {
            foreach ($order->items as $item) {
                $item->product->increment('stok', $item->quantity);
            }
        }

        $order->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Pesanan berhasil dihapus!');
    }
}