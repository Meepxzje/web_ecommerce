<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quatang extends Model
{
    use HasFactory;

    protected $table = 'quatangs';

    protected $fillable = [
        'sanphamidquatang', 'mota', 'soluong', 'sanphamid','ngayketthuc'
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamidquatang' );
    }
}
