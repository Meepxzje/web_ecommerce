<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietmagiamgia extends Model
{
    use HasFactory;


    protected $table = 'chitietmagiamgias';

    protected $fillable = [
        'nguoidungid',
        'magiamgiaid',
        'ngayhethan',
        'dasudung'
    ];

    public function nguoidung()
    {
        return $this->belongsTo(Nguoidung::class, 'nguoidungid');
    }

    public function magiamgia()
    {
        return $this->belongsTo(Magiamgia::class, 'magiamgiaid');
    }
}
