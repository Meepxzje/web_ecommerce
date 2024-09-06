<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phuongthucthanhtoan extends Model
{
    use HasFactory;

    protected $table = 'phuongthucthanhtoan';
    protected $fillable = ['ten'];

    public function donhangs()
    {
        return $this->hasMany(Donhang::class, 'phuongthucthanhtoanid');
    }
}

