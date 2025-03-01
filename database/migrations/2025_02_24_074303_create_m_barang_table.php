<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMBarangTable extends Migration {
    public function up(): void {
        Schema::create('m_barang', function (Blueprint $table) {
            $table->id('barang_id');
            $table->string('nama_barang', 100);
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->unsignedBigInteger('kategori_id');
            $table->timestamps();

            // Tambahkan foreign key
            $table->foreign('kategori_id')->references('kategori_id')->on('m_kategori')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('m_barang');
    }
}
