<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loaisanphams')->truncate();

        $data = [
            [
                'tenlsp' => 'Loại sản phẩm 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenlsp' => 'Loại sản phẩm 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenlsp' => 'Loại sản phẩm 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('loaisanphams')->insert($data);
    }
}
