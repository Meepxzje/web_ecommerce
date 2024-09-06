<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loaibanphim extends Model
{
    use HasFactory;
    protected $table = 'loaibanphims';
    protected $fillable = ['ten'];
}
