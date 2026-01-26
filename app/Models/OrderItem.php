<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model  // ← HARUS OrderItem, BUKAN Product!
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'nama_produk',
        'size',
        'quantity',
        'harga',
        'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}