<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('kategori');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', '%' . $search . '%')
                  ->orWhereHas('kategori', function($q) use ($search) {
                      $q->where('nama_kategori', 'like', '%' . $search . '%');
                  });
            });
        }

        // Pagination 
        $products = $query->latest()->paginate(10)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();

        return view('admin.products.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'size'        => 'required|string',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|integer|min:0',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'   => 'required|string',
        ]);

        // Upload gambar
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('products', 'public');
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'size'        => $request->size,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'gambar'      => $gambarPath,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('kategori')->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product   = Product::findOrFail($id);
        $kategoris = Kategori::all();

        return view('admin.products.edit', compact('product', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'size'        => 'required|string',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'   => 'required|string',
        ]);

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            // Upload gambar baru
            $gambarPath = $request->file('gambar')->store('products', 'public');
            $product->gambar = $gambarPath;
        }

        // Update data produk
        $product->update([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'size'        => $request->size,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar jika ada
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}