<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giohang extends Model
{
    use HasFactory;

    protected $table = 'giohang';
    protected $fillable = ['nguoidungid'];

    public function nguoidung()
    {
        return $this->belongsTo(Nguoidung::class, 'nguoidungid');
    }

    public function chitietgiohangs()
    {
        return $this->hasMany(Chitietgiohang::class, 'giohangid');
    }
}

