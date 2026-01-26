<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('nama_produk');
            $table->foreignId('kategori_id')
                  ->constrained('kategoris')
                  ->cascadeOnDelete();

            $table->string('size', 10); // S, M, L, XL
            $table->integer('stok');
            $table->integer('harga');

            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
