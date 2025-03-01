<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTStokTable extends Migration {
    public function up(): void {
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id');
            $table->unsignedBigInteger('barang_id');
            $table->integer('jumlah');
            $table->date('tanggal_masuk');
            $table->timestamps();

            $table->foreign('barang_id')->references('barang_id')->on('m_barang');
        });
    }

    public function down(): void {
        Schema::dropIfExists('t_stok');
    }
}
