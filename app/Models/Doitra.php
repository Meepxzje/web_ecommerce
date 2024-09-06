<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doitra extends Model
{
    use HasFactory;

    protected $table = 'doitras';

    protected $fillable = [
        'donhangid',
        'nguoidungid',
        'lydo',
        'tinhtrang'
    ];

    public function donhang()
    {
        return $this->belongsTo(Donhang::class, 'donhangid');
    }

    public function nguoidung()
    {
        return $this->belongsTo(Nguoidung::class, 'nguoidungid');
    }

    public function chitietdoitras()
    {
        return $this->hasMany(Chitietdoitra::class, 'doitraid');
    }
    public function soluongsanpham()
    {
        return $this->chitietdoitras()->count();
    }
}
