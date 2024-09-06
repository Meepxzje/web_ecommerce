<?php

namespace Database\Seeders;

use App\Models\Sanpham;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class SanphamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Tạo dữ liệu mẫu cho bảng 'sanphams'
        foreach (range(1, 50) as $index) {
            Sanpham::create([
                'ten_san_pham' => $faker->name,
                'gia' => $faker->randomFloat(2, 50, 5000),
                'mota' => $faker->text(250),
                'img1' => $faker->imageUrl(640, 480, 'product'),
                'idnsx' => $faker->numberBetween(1, 10),
                'idlsp' => $faker->numberBetween(1, 10),
                'idncc' => $faker->numberBetween(1, 10),
                'bao_hanh' => $faker->randomElement(['Bảo hành 12 tháng', 'Bảo hành 24 tháng', 'Bảo hành 36 tháng']),
                'bo_xu_ly' => $faker->randomElement(['Intel Core i5', 'Intel Core i7', 'AMD Ryzen 5', 'AMD Ryzen 7']),
                'toc_do_xung_nhip_co_ban' => $faker->randomFloat(2, 2.0, 4.0),
                'toc_do_tang_cuon_toi_da' => $faker->randomFloat(2, 3.0, 5.0),
                'tong_dung_luong_bo_nho_da_cai_dat' => $faker->randomElement(['256GB SSD', '512GB SSD', '1TB HDD']),
                'loai_bo_nho' => $faker->randomElement(['SSD', 'HDD', 'SSD + HDD']),
                'toc_do_bo_nho' => $faker->numberBetween(1600, 3600),
                'bo_nho_gan_lien' => $faker->randomElement(['Integrated Graphics', 'NVIDIA GeForce GTX 1650', 'AMD Radeon RX 560X']),
                'khe_cam_bo_nho_kha_dung' => $faker->randomElement(['USB Type-C', 'USB 3.0', 'USB 2.0']),
                'loai_do_hoa' => $faker->randomElement(['Integrated', 'Dedicated']),
                'gpu' => $faker->randomElement(['Intel UHD Graphics', 'NVIDIA GeForce GTX 1660 Ti', 'AMD Radeon RX 5500M']),
                'loai_man_hinh' => $faker->randomElement(['IPS', 'TN', 'VA']),
                'kich_thuoc_man_hinh' => $faker->randomElement(['15.6"', '14"', '17.3"']),
                'ty_le_khung_hinh' => $faker->randomElement(['16:9', '16:10', '4:3']),
                'do_phan_giai_goc' => $faker->randomElement(['1920x1080', '1366x768', '2560x1440']),
                'man_hinh_cam_ung' => $faker->randomElement(['Yes', 'No']),
                'be_mat' => $faker->randomElement(['Matte', 'Glossy']),
                'do_sang' => $faker->numberBetween(200, 500),
                'khe_cam_kha_dung' => $faker->randomElement(['USB Type-A', 'HDMI', 'VGA']),
                'tong_dung_luong' => $faker->randomElement(['512GB', '1TB', '2TB']),
                'luu_tru_the_ran' => $faker->randomElement(['8GB DDR4', '16GB DDR4', '32GB DDR4']),
                'o_dia_quang' => $faker->randomElement(['DVD-RW', 'Blu-ray', 'None']),
                'cong_ket_noi_vao_ra' => $faker->randomElement(['USB Type-C', 'USB 3.1', 'Thunderbolt 3']),
                'dau_ra_tai_nghe' => $faker->numberBetween(1, 3),
                'loa_tich_hop' => $faker->numberBetween(1, 2),
                'micro_tich_hop' => $faker->numberBetween(1, 2),
                'khe_mo_rong' => $faker->randomElement(['SD Card Reader', 'ExpressCard', 'Smart Card Reader']),
                'khe_cam_the_nho' => $faker->randomElement(['SD', 'microSD', 'CompactFlash']),
                'ket_noi_mang' => $faker->randomElement(['Ethernet', 'Wi-Fi', 'LTE']),
                'modem' => $faker->randomElement(['4G LTE', '5G']),
                'wifi' => $faker->randomElement(['802.11ac', '802.11ax', '802']),
                'bluetooth' => $faker->randomElement(['Bluetooth 4.2', 'Bluetooth 5.0', 'Bluetooth 5.2']),
                'di_dong_bang_thong_rong' => $faker->randomElement(['3G', '4G', '5G']),
                'gps' => $faker->randomElement(['GPS', 'GLONASS', 'Galileo']),
                'nfc' => $faker->randomElement(['Yes', 'No']),
                'webcam' => $faker->randomElement(['720p HD', '1080p Full HD', '4K UHD']),
                'loai_pin' => $faker->randomElement(['Li-Ion', 'Li-Polymer']),
                'watt_gio' => $faker->numberBetween(3000, 10000),
                'thoi_gian_su_dung_toi_da' => $faker->numberBetween(5, 12),
                'yeu_cau_nguon_dien' => $faker->randomElement(['AC 100-240V', 'AC 120V', 'AC 230V']),
                'bo_cung_cap_nguon' => $faker->randomElement(['65W', '90W', '135W']),
                'he_dieu_hanh' => $faker->randomElement(['Windows 10 Home', 'Windows 10 Pro', 'macOS']),
                'bao_mat' => $faker->randomElement(['Fingerprint Reader', 'Face Recognition', 'Password']),
                'so_luong_phim' => $faker->numberBetween(80, 120),
                'loai_ban_phim' => $faker->randomElement(['Chiclet', 'Mechanical', 'Membrane']),
                'tinh_nang' => $faker->randomElement(['Backlit', 'Numeric Keypad', 'Macro Keys']),
                'kha_nang_nang_cap' => $faker->randomElement(['Up to 32GB RAM', 'Up to 1TB SSD', 'Up to RTX 3080']),
                'kich_thuoc_w_h_d' => $faker->randomElement(['360 x 250 x 20 mm', '380 x 270 x 22 mm', '335 x 230 x 18 mm']),
                'trong_luong' => $faker->randomElement(['1.5 kg', '1.8 kg', '2.0 kg']),
            ]);
        }
    }
}
