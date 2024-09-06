<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhacungcapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Xóa dữ liệu cũ trong bảng nếu có
        DB::table('nhacungcaps')->truncate();

        // Tạo dữ liệu mẫu cho bảng nhacungcaps
        $data = [
            [
                'tenncc' => 'Nhà cung cấp 1',
                'diachincc' => 'Địa chỉ 1',
                'sdtncc' => '0123456789',
                'imgncc' => 'img1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenncc' => 'Nhà cung cấp 2',
                'diachincc' => 'Địa chỉ 2',
                'sdtncc' => '0987654321',
                'imgncc' => 'img2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenncc' => 'Nhà cung cấp 3',
                'diachincc' => 'Địa chỉ 3',
                'sdtncc' => '0369852147',
                'imgncc' => 'img3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm dữ liệu mẫu khác nếu cần
        ];

        // Insert dữ liệu vào bảng
        DB::table('nhacungcaps')->insert($data);
    }
}
