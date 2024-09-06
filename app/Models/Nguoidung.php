<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class Nguoidung extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, Notifiable;

    protected $table = 'nguoidung';

    protected $fillable = [
        'ten', 'email', 'matkhau', 'sodienthoai', 'diachi', 'matp', 'maqh', 'xaid', 'role', 'img', 'email_verified_at',
    ];

    public function giohang()
    {
        return $this->hasOne(Giohang::class, 'nguoidungid');
    }

    public function donhangs()
    {
        return $this->hasMany(Donhang::class, 'nguoidungid');
    }

    public function binhluans()
    {
        return $this->hasMany(Binhluan::class, 'nguoidungid');
    }

    public function danhgias()
    {
        return $this->hasMany(Danhgia::class, 'nguoidungid');
    }

    public function thanhpho()
    {
        return $this->belongsTo(Thanhpho::class, 'matp', 'matp');
    }

    public function quanhuyen()
    {
        return $this->belongsTo(Quanhuyen::class, 'maqh', 'maqh');
    }

    public function xaphuong()
    {
        return $this->belongsTo(Xaphuong::class, 'xaid', 'xaid');
    }

    protected $hidden = [
        'matkhau', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getEmailForVerification()
    {
        return $this->email;
    }
    public function getEmailVerifiedAtColumn()
    {
        return 'email_verified_at';
    }
    public function getAuthPassword()
    {
        return $this->matkhau;
    }

    public function quantams()
    {
        return $this->hasMany(Quantam::class, 'nguoidungid');
    }

    public function slgiohang()
    {
        return $this->giohang
            ? $this->giohang->chitietgiohangs()->distinct('sanphamid')->count('sanphamid')
            : 0;
    }

    public function sldonhang()
    {
        return $this->donhangs()
            ->where('tinhtrang', '!=', 'Hoàn thành') // Trạng thái không phải "Hoàn thành"
            ->where('tinhtrang', 'not like', 'Đã hủy%') // Trạng thái không bắt đầu với "Đã hủy"
            ->count();
    }
    public function slquantam()
    {
        return $this->quantams()
            ->withCount('chitietquantams')
            ->get()
            ->sum('chitietquantams_count');
    }
    public function chitietmagiamgias()
    {
        return $this->hasMany(Chitietmagiamgia::class, 'nguoidungid');
    }

    public function slmgg()
    {
        return $this->chitietmagiamgias()
            ->where('dasudung', 0)
            ->where('ngayhethan', '>=', Carbon::today())
            ->count();
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
