<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keycap extends Model
{
    use HasFactory;
    protected $table = 'keycap';
    protected $fillable = ['ten'];
}
