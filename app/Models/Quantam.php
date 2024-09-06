<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quantam extends Model
{
    use HasFactory;
    protected $table = 'quantams';

    protected $fillable = ['nguoidungid'];

    public function nguoidung()
    {
        return $this->belongsTo(Nguoidung::class, 'nguoidungid');
    }

    public function chitietquantams()
    {
        return $this->hasMany(Chitietquantam::class, 'quantamid');
    }
}

