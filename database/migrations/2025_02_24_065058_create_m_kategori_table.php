<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMKategoriTable extends Migration {
    public function up(): void {
        Schema::create('m_kategori', function (Blueprint $table) {
            // $table->id();
            // $table->string('kategori_kode');
            // $table->string('kategori_nama');
            // $table->timestamps();
            $table->id('kategori_id'); // Pastikan ada ID utama
            $table->string('nama_kategori');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('m_kategori');
    }
}