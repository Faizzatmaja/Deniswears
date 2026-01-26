<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan halaman cart
    public function index()
    {
        // Ambil item cart milik user yang sedang login
        $cartItems = Cart::with('product.kategori')
            ->where('user_id', Auth::id())
            ->get();
        
        // Ambil semua products dari database (yang dikelola admin)
        $products = Product::with('kategori')->get();
        
        // Hitung total products
        $totalProducts = $products->count();
        
        return view('user.cart', compact('cartItems', 'products', 'totalProducts'));
    }

    // Tambah produk ke cart dengan size dan quantity dari modal
    public function add(Request $request, $productId)
    {
        // Validasi input dari modal
        $request->validate([
            'size' => 'required|string|in:S,M,L,XL',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $product = Product::findOrFail($productId);
        
        // Cek apakah produk masih ada stok
        if ($product->stok <= 0) {
            return back()->with('error', 'Produk sedang habis stok');
        }
        
        // Cek apakah quantity yang diminta melebihi stok
        if ($request->quantity > $product->stok) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia');
        }
        
        // Cek apakah produk dengan SIZE yang sama sudah ada di cart user
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->where('size', $request->size)
            ->first();
        
        if ($cartItem) {
            // Jika sudah ada dengan size yang sama, tambah quantity
            $newQuantity = $cartItem->quantity + $request->quantity;
            
            // Cek apakah total quantity tidak melebihi stok
            if ($newQuantity > $product->stok) {
                return back()->with('error', 'Total jumlah melebihi stok yang tersedia');
            }
            
            $cartItem->update([
                'quantity' => $newQuantity
            ]);
            
            return back()->with('success', 'Jumlah produk berhasil ditambah di keranjang');
        } else {
            // Jika belum ada atau size berbeda, buat cart item baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity,
                'size' => $request->size,
                'notes' => ''
            ]);
            
            return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
        }
    }

    // Update cart item (quantity, size, notes)
    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string|max:10',
            'notes' => 'nullable|string|max:255'
        ]);
        
        $cartItem = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        // Cek apakah quantity tidak melebihi stok
        if ($request->quantity > $cartItem->product->stok) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia');
        }
        
        // Update semua field
        $cartItem->update([
            'quantity' => $request->quantity,
            'size' => $request->size,
            'notes' => $request->notes ?? '',
        ]);
        
        return back()->with('success', 'Produk berhasil diperbarui');
    }

    // Hapus item dari cart
    public function remove($cartId)
    {
        $cartItem = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $cartItem->delete();
        
        return back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    // Hapus semua item di cart
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        
        return back()->with('success', 'Keranjang berhasil dikosongkan');
    }
}