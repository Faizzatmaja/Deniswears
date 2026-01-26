<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar dengan relasi kategori
        $query = Product::with('kategori');
        
        // Filter berdasarkan kategori jika ada
        if ($request->has('category') && $request->category) {
            // Cari kategori berdasarkan nama
            $kategori = Kategori::where('nama_kategori', 'like', '%' . $request->category . '%')->first();
            if ($kategori) {
                $query->where('kategori_id', $kategori->id);
            }
        }
        
        // Filter berdasarkan pencarian jika ada
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }
        
        // Ambil semua produk dengan filter
        $products = $query->latest()->get();
        
        // Total produk
        $totalProducts = Product::count();
        
        // Ambil semua kategori dari database
        $allKategori = Kategori::all();
        
        // Kategori dengan jumlah produk
        $categories = [];
        foreach ($allKategori as $kat) {
            $categoryName = strtolower($kat->nama_kategori);
            $categories[$categoryName] = Product::where('kategori_id', $kat->id)->count();
        }
        
        return view('user.home', compact(
            'products',
            'totalProducts',
            'categories'
        ));
    }
    
    /**
     * Menampilkan detail produk dalam format JSON
     * Untuk modal detail produk
     */
    public function show($id)
    {
        try {
            $product = Product::with('kategori')->findOrFail($id);
            
            return response()->json([
                'id' => $product->id,
                'nama_produk' => $product->nama_produk,
                'deskripsi' => $product->deskripsi,
                'harga' => $product->harga,
                'harga_diskon' => $product->harga_diskon,
                'stok' => $product->stok,
                'gambar' => $product->gambar,
                'kategori' => [
                    'id' => $product->kategori->id ?? null,
                    'nama_kategori' => $product->kategori->nama_kategori ?? 'Uncategorized'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Produk tidak ditemukan'
            ], 404);
        }
    }
}