<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhacungcap extends Model
{
    use HasFactory;

    protected $table = 'nhacungcap';

    protected $fillable = ['ten', 'diachi', 'sodienthoai', 'email','img'];

    public function sanphams()
    {
        return $this->hasMany(Sanpham::class, 'nhacungcapid');
    }
}

