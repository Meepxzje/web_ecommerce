<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giamgiahangloat extends Model
{
    use HasFactory;

    protected $table = 'giamgiahangloats';

    protected $fillable = [
        'sanphamid', 'phantramgiamgia', 'giamtoida', 'ngaybatdau', 'ngayketthuc', 'soluongsanpham','tinhtrang'
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $today = Carbon::today();
            $ngaybatdau = Carbon::parse($model->ngaybatdau);
            $ngayketthuc = Carbon::parse($model->ngayketthuc);

            if ($ngaybatdau <= $today && $today <= $ngayketthuc && $model->soluongsanpham>0) {
                $model->tinhtrang = 1;
            } elseif ($ngaybatdau > $today) {
                $model->tinhtrang = 2;
            } else {
                $model->tinhtrang = 0;
            }
        });
    }
}
