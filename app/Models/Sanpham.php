<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;
    protected $table = 'sanpham';

    protected $fillable = [
        'ten', 'danhmucid', 'nhasanxuatid', 'nhacungcapid', 'mota', 'gia', 'soluong', 'daban'
    ];

    public function danhmuc()
    {
        return $this->belongsTo(Danhmuc::class, 'danhmucid');
    }

    public function nhasanxuat()
    {
        return $this->belongsTo(Nhasanxuat::class, 'nhasanxuatid');
    }

    public function nhacungcap()
    {
        return $this->belongsTo(Nhacungcap::class, 'nhacungcapid');
    }

    public function thongsohieunang()
    {
        return $this->hasOne(Thongsohieunang::class, 'sanphamid');
    }
    public function thongsomanhinh()
    {
        return $this->hasOne(Thongsomanhinh::class, 'sanphamid');
    }

    public function thongsoluutru()
    {
        return $this->hasOne(Thongsoluutru::class, 'sanphamid');
    }

    public function thongsoketnoi()
    {
        return $this->hasOne(Thongsoketnoi::class, 'sanphamid');
    }

    public function thongsotruyenthong()
    {
        return $this->hasOne(Thongsotruyenthong::class, 'sanphamid');
    }

    public function thongsopin()
    {
        return $this->hasOne(Thongsopin::class, 'sanphamid');
    }

    public function thongsotongquat()
    {
        return $this->hasOne(Thongsotongquat::class, 'sanphamid');
    }

    public function thongsopkmanhinh()
    {
        return $this->hasOne(Thongsopkmanhinh::class, 'sanphamid');
    }
    public function thongsopkram()
    {
        return $this->hasOne(Thongsopkram::class, 'sanphamid');
    }
    public function thongsopkbanphim()
    {
        return $this->hasOne(Thongsopkbanphim::class, 'sanphamid');
    }

    public function thongsopkchuot()
    {
        return $this->hasOne(Thongsopkchuot::class, 'sanphamid');
    }
    public function thongsopktainghe()
    {
        return $this->hasOne(Thongsopktainghe::class, 'sanphamid');
    }


    public function binhluans()
    {
        return $this->hasMany(Binhluan::class);
    }

    public function danhgias()
    {
        return $this->hasMany(Danhgia::class);
    }

    public function hinhanhsanphams()
    {
        return $this->hasMany(Hinhanhsanpham::class, 'sanphamid');
    }

    public function quatangs()
    {
        return $this->hasMany(Quatang::class, 'sanphamid');
    }
    public function giamgia()
    {
        return $this->hasOne(Giamgia::class, 'sanphamid');
    }
    public function giamgiahangloat()
    {
        return $this->hasOne(Giamgiahangloat::class, 'sanphamid');
    }
    public function magiamgias()
    {
        return $this->belongsToMany(Magiamgia::class, 'magiamgiasp', 'sanphamid', 'magiamgiaid');
    }
    public function chitietquantams()
    {
        return $this->hasMany(Chitietquantam::class, 'sanphamid');
    }


    public function luotxems()
    {
        return $this->hasMany(Luotxem::class, 'sanphamid');
    }

    public function muasanphams()
    {
        return $this->hasMany(Mua::class, 'sanphamid');
    }
}
