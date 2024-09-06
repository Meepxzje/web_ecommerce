<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    use HasFactory;
    protected $table = 'donhang';

    protected $fillable = ['nguoidungid', 'phuongthucthanhtoanid', 'tinhtrang', 'ngaydat', 'diachigiaohang','phiship','magiamgia', 'tongtien','mavandon'];

    public function nguoidung()
    {
        return $this->belongsTo(Nguoidung::class, 'nguoidungid');
    }

    public function phuongthucthanhtoan()
    {
        return $this->belongsTo(Phuongthucthanhtoan::class, 'phuongthucthanhtoanid');
    }

    public function chitietmgg()
    {
        return $this->belongsTo(Chitietmagiamgia::class, 'magiamgia');
    }

    public function chitietdonhangs()
    {
        return $this->hasMany(Chitietdonhang::class, 'donhangid');
    }
    public function soluongsanpham()
    {
        return $this->chitietdonhangs()->count();
    }
}
