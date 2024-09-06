<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hinhanhsanpham extends Model
{
    use HasFactory;
    protected $table = 'hinhanhsanpham';

    protected $fillable = ['sanphamid', 'img'];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
}
