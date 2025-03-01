<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPenjualanTable extends Migration {
    public function up(): void {
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->id('penjualan_id');
            $table->date('tanggal_penjualan');
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }

    public function down(): void {
        Schema::dropIfExists('t_penjualan');
    }
}
