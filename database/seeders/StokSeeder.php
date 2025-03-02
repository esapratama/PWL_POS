<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_stok')->insert([
            ['barang_id' => 1, 'jumlah' => 50, 'tanggal_masuk' => now()],
            ['barang_id' => 2, 'jumlah' => 30, 'tanggal_masuk' => now()],
            ['barang_id' => 3, 'jumlah' => 100, 'tanggal_masuk' => now()],
            ['barang_id' => 4, 'jumlah' => 75, 'tanggal_masuk' => now()],
            ['barang_id' => 5, 'jumlah' => 200, 'tanggal_masuk' => now()],
            ['barang_id' => 6, 'jumlah' => 500, 'tanggal_masuk' => now()],
            ['barang_id' => 7, 'jumlah' => 20, 'tanggal_masuk' => now()],
            ['barang_id' => 8, 'jumlah' => 100, 'tanggal_masuk' => now()],
            ['barang_id' => 9, 'jumlah' => 300, 'tanggal_masuk' => now()],
            ['barang_id' => 10, 'jumlah' => 150, 'tanggal_masuk' => now()]
        ]);
    }
}
