<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Busram extends Model
{
    use HasFactory;
    protected $table = 'busrams';
    protected $fillable = ['ten'];
}
