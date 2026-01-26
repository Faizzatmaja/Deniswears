<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'kategoris';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'gambar',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Relationship: Kategori has many products
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'kategori_id');
    }

    /**
     * Scope: Only active categories
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope: Only inactive categories
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Get products count
     */
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }

    /**
     * Check if kategori is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return $this->status === 'active' 
            ? 'bg-green-100 text-green-800' 
            : 'bg-red-100 text-red-800';
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        return $this->status === 'active' ? 'Aktif' : 'Tidak Aktif';
    }
}