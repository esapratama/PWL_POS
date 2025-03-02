<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = [1, 2, 3];

        for ($i = 1; $i <= 10; $i++) {
            DB::table('t_penjualan')->insert([
                'tanggal_penjualan' => now(),
                'user_id' => $userIds[array_rand($userIds)],
                'total_harga' => rand(100000, 5000000)
            ]);
        }
    }
}
