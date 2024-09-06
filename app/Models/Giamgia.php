<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Giamgia extends Model
{
    use HasFactory;

    protected $table = 'giamgias';

    protected $fillable = [
        'sanphamid', 'giagiam', 'danggiam', 'ngaybatdau', 'ngayketthuc', 'soluongsanpham'
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->updateDanggiam();
        });
    }

    public function updateDanggiam()
    {
        $today = Carbon::today();
        $ngaybatdau = Carbon::parse($this->ngaybatdau);
        $ngayketthuc = Carbon::parse($this->ngayketthuc);

        if ($ngaybatdau <= $today && $today <= $ngayketthuc && $this->soluongsanpham > 0) {
            $this->danggiam = 1;
        } elseif ($ngaybatdau > $today) {
            $this->danggiam = 2;
        } else {
            $this->danggiam = 0;
        }
    }
}
