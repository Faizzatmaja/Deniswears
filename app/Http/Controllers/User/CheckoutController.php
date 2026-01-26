<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Halaman checkout
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        
        if ($cartItems->count() === 0) {
            return redirect()->route('user.cart')->with('error', 'Keranjang belanja kosong');
        }

        // Hitung total
        $total = 0;
        foreach($cartItems as $item) {
            $price = $item->product->harga_diskon ?? $item->product->harga;
            $total += $price * $item->quantity;
        }

        return view('user.checkout', compact('cartItems', 'total'));
    }

    // Proses checkout
    public function process(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'metode_pembayaran' => 'required|in:transfer_bank,cod,ewallet',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        
        if ($cartItems->count() === 0) {
            return redirect()->route('user.cart')->with('error', 'Keranjang belanja kosong');
        }

        DB::beginTransaction();
        
        try {
            // Hitung total
            $total = 0;
            foreach($cartItems as $item) {
                $price = $item->product->harga_diskon ?? $item->product->harga;
                $total += $price * $item->quantity;
            }

            // Buat order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => Auth::id(),
                'nama_lengkap' => $validated['nama_lengkap'],
                'no_telepon' => $validated['no_telepon'],
                'alamat_lengkap' => $validated['alamat_lengkap'],
                'total' => $total,
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'status' => 'diproses',
            ]);

            // Buat order items
            foreach ($cartItems as $item) {
                $price = $item->product->harga_diskon ?? $item->product->harga;
                $subtotal = $price * $item->quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'nama_produk' => $item->product->nama_produk,
                    'size' => $item->size,
                    'quantity' => $item->quantity,
                    'harga' => $price,
                    'subtotal' => $subtotal,
                ]);

                // Kurangi stok
                $item->product->decrement('stok', $item->quantity);
            }

            // Kosongkan keranjang
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('user.orders')
                ->with('success', 'Pesanan berhasil dibuat! Nomor pesanan: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}