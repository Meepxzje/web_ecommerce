<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietgiohang extends Model
{
    use HasFactory;

    protected $table = 'chitietgiohang';

    protected $fillable = ['giohangid', 'sanphamid', 'soluong'];

    public function giohang()
    {
        return $this->belongsTo(Giohang::class, 'giohangid');
    }

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }

 

}
