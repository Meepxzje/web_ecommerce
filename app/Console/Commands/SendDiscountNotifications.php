<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Nguoidung;
use Illuminate\Support\Facades\Mail;

class SendDiscountNotifications extends Command
{
    protected $signature = 'notify:discounts';
    protected $description = 'Gửi thông báo về giảm giá cho người dùng';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $nguoidungs = Nguoidung::all();
        foreach ($nguoidungs as $nguoidung) {
            $productsWithDiscounts = [];

            $quantams = $nguoidung->quantams;
            foreach ($quantams as $quantam) {
                $chitietquantams = $quantam->chitietquantams;
                foreach ($chitietquantams as $chitietquantam) {
                    $sanpham = $chitietquantam->sanpham;
                    $giamgias = $sanpham->giamgia()->where('danggiam', 1)->get();
                    $giamgiahangloats = $sanpham->giamgiahangloat()->where('tinhtrang', 1)->get();

                    if ($giamgias->count() > 0 || $giamgiahangloats->count() > 0) {
                        $productsWithDiscounts[] = [
                            'sanpham' => $sanpham,
                            'giamgias' => $giamgias,
                            'giamgiahangloats' => $giamgiahangloats
                        ];
                    }
                }
            }

            if (count($productsWithDiscounts) > 0) {
                $this->sendEmail($nguoidung, $productsWithDiscounts);
            }
        }
    }

    private function sendEmail($nguoidung, $productsWithDiscounts)
    {
        $data = [
            'nguoidung' => $nguoidung,
            'productsWithDiscounts' => $productsWithDiscounts,
        ];

        Mail::send('emails.discount', $data, function ($message) use ($nguoidung) {
            $message->to($nguoidung->email);
            $message->subject('Sản phẩm bạn quan tâm đang giảm giá!');
        });
    }
}
