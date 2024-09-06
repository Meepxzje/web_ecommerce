<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magiamgia extends Model
{
    use HasFactory;

    protected $table = 'magiamgias';

    protected $fillable = [
        'magiamgia',
        'phantramgiamgia',
        'giamtructiep',
        'sotiengiamgiatoida',
        'giatritoithieudonhang',
        'soluong',
        'tinhtrang',
    ];

    public function chitietmagiamgia()
    {
        return $this->hasMany(Chitietmagiamgia::class, 'magiamgiaid');
    }

    public function sanpham()
    {
        return $this->belongsToMany(Sanpham::class, 'magiamgiasp', 'magiamgiaid', 'sanphamid');
    }
}
