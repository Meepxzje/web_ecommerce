<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhasanxuat extends Model
{
    use HasFactory;

    protected $table = 'nhasanxuat';

    protected $fillable = ['ten', 'diachi', 'sodienthoai', 'email','img'];

    public function sanphams()
    {
        return $this->hasMany(Sanpham::class, 'nhasanxuatid');
    }
}
