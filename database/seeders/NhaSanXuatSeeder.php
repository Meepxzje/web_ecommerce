<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhaSanXuatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Xóa dữ liệu cũ trong bảng nếu có
        DB::table('nhasanxuats')->truncate();

        // Tạo dữ liệu mẫu cho bảng nhasanxuats
        $data = [
            [
                'tennsx' => 'Nhà sản xuất 1',
                'sdtnsx' => '0123456789',
                'diachinsx' => 'Địa chỉ 1',
                'imgnsx' => 'img1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tennsx' => 'Nhà sản xuất 2',
                'sdtnsx' => '0987654321',
                'diachinsx' => 'Địa chỉ 2',
                'imgnsx' => 'img2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tennsx' => 'Nhà sản xuất 3',
                'sdtnsx' => '0369852147',
                'diachinsx' => 'Địa chỉ 3',
                'imgnsx' => 'img3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm dữ liệu mẫu khác nếu cần
        ];

        // Insert dữ liệu vào bảng
        DB::table('nhasanxuats')->insert($data);
    }
}
