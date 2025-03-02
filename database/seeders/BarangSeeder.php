<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_barang')->insert([
            ['nama_barang' => 'TV LED 32 Inch', 'harga' => 2500000, 'kategori_id' => 1, 'stok' => 50],
            ['nama_barang' => 'Kulkas 2 Pintu', 'harga' => 3500000, 'kategori_id' => 1, 'stok' => 30],
            ['nama_barang' => 'Kemeja Pria', 'harga' => 150000, 'kategori_id' => 2, 'stok' => 100],
            ['nama_barang' => 'Celana Jeans', 'harga' => 200000, 'kategori_id' => 2, 'stok' => 75],
            ['nama_barang' => 'Roti Tawar', 'harga' => 25000, 'kategori_id' => 3, 'stok' => 200],
            ['nama_barang' => 'Mie Instan', 'harga' => 5000, 'kategori_id' => 3, 'stok' => 500],
            ['nama_barang' => 'Meja Kayu', 'harga' => 750000, 'kategori_id' => 4, 'stok' => 20],
            ['nama_barang' => 'Kursi Plastik', 'harga' => 100000, 'kategori_id' => 4, 'stok' => 100],
            ['nama_barang' => 'Pulpen Biru', 'harga' => 5000, 'kategori_id' => 5, 'stok' => 300],
            ['nama_barang' => 'Buku Tulis', 'harga' => 15000, 'kategori_id' => 5, 'stok' => 150]
        ]);
    }
}
