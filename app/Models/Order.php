<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'nama_lengkap',
        'no_telepon',
        'alamat_lengkap',
        'total',
        'metode_pembayaran',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Generate Order Number
    public static function generateOrderNumber()
    {
        $prefix = 'DW';
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid(rand(), true)), 0, 4));
        
        return $prefix . $date . $random;
    }

    // Status Badge Color
    public function getStatusBadgeColor()
    {
        return match($this->status) {
            'diproses' => 'bg-blue-500',
            'dikirim' => 'bg-purple-500',
            'selesai' => 'bg-green-500',
            'dibatalkan' => 'bg-red-500',
            default => 'bg-gray-500',
        };
    }
}