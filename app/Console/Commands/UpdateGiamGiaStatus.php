<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GiamGia;
use App\Models\Giamgiahangloat;
use Carbon\Carbon;

class UpdateGiamGiaStatus extends Command
{
    protected $signature = 'giamgia:update-status';
    protected $description = 'Update the danggiam status for all GiamGia records';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $giamgias = GiamGia::all();
        $giamgiahangloats = Giamgiahangloat::all();
        foreach ($giamgias as $giamgia) {
            $this->updateDanggiam($giamgia);
        }
        foreach ($giamgiahangloats as $giamgia) {
            $this->updateDanggiamhangloat($giamgia);
        }


        $this->info('GiamGia status updated successfully!');
    }

    private function updateDanggiam($giamgia)
    {
        $today = Carbon::today();
        $ngaybatdau = Carbon::parse($giamgia->ngaybatdau);
        $ngayketthuc = Carbon::parse($giamgia->ngayketthuc);

        if ($ngaybatdau <= $today && $today <= $ngayketthuc) {
            $giamgia->danggiam = 1;
        } elseif ($ngaybatdau > $today) {
            $giamgia->danggiam = 2;
        } else {
            $giamgia->danggiam = 0;
        }

        $giamgia->save();
    }
    private function updateDanggiamhangloat($giamgiahangloats)
    {
        $today = Carbon::today();
        $ngaybatdau = Carbon::parse($giamgiahangloats->ngaybatdau);
        $ngayketthuc = Carbon::parse($giamgiahangloats->ngayketthuc);

        if ($ngaybatdau <= $today && $today <= $ngayketthuc) {
            $giamgiahangloats->tinhtrang = 1;
        } elseif ($ngaybatdau > $today) {
            $giamgiahangloats->tinhtrang = 2;
        } else {
            $giamgiahangloats->tinhtrang = 0;
        }
        $giamgiahangloats->save();
    }
}
