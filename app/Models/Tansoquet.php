<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tansoquet extends Model
{
    use HasFactory;

    protected $table = 'tansoquets';
    protected $fillable = ['ten'];
}
