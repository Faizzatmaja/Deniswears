<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'size',
        'stok',
        'harga',
        'gambar',
        'deskripsi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Relasi ke order items (untuk menghitung total penjualan)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}