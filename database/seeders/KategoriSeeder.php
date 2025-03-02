<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_kategori')->insert([
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Pakaian'],
            ['nama_kategori' => 'Makanan'],
            ['nama_kategori' => 'Perabotan'],
            ['nama_kategori' => 'Alat Tulis']
        ]);
    }
}
