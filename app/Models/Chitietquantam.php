<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietquantam extends Model
{
    use HasFactory;

    protected $table = 'chitietquantams';

    protected $fillable = ['quantamid', 'sanphamid'];

    public function quantam()
    {
        return $this->belongsTo(Quantam::class, 'quantamid');
    }

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
}
