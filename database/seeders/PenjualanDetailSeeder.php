<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $penjualan_ids = DB::table('t_penjualan')->pluck('penjualan_id')->toArray();

    for ($penjualan = 1; $penjualan <= 10; $penjualan++) {
        if (!in_array($penjualan, $penjualan_ids)) continue; // Skip kalau penjualan_id nggak ada

        for ($i = 1; $i <= 3; $i++) {
            DB::table('t_penjualan_detail')->insert([
                'penjualan_id' => $penjualan,
                'barang_id' => rand(1, 10),
                'jumlah' => rand(1, 5),
                'harga_satuan' => rand(5000, 1000000)
            ]);
        }
    }
}
}